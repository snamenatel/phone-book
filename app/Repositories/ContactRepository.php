<?php


namespace App\Repositories;


use App\Exceptions\CreateDuplicateModelException;
use App\Http\Requests\ContactSearchRequest;
use App\Http\Requests\ContactStoreRequest;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use App\Models\Phone;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ContactRepository
{
    public function search(ContactSearchRequest $request): Collection
    {
        return Contact::with(['phones', 'author:id,name'])
            ->when($request->name, fn($query) => $query->where('name', 'LIKE', "%{$request->name}%"))
            ->when($request->phone, function ($query) use ($request) {
                $query->whereHas('phones', fn($q) => $q->where('phone', 'LIKE', "%{$request->phone}%"));
            })
            ->when($request->author, function ($query) use ($request) {
                $query->whereHas('author', fn($q) => $q->where('name', 'LIKE', "%{$request->author}%"));
            })
            ->orderBy('name')
            ->get();
    }

    public function store(ContactStoreRequest $request): ContactResource
    {
        if ($this->findByPhones($request->phone)->isNotEmpty()) {
            throw new CreateDuplicateModelException('Create user with existing email');
        }

        $contact = Contact::create($request->only('name'));
        $phones = collect($request->phone)->map(fn($el) => ['phone' => $this->formatPhoneToSearch($el)])->toArray();
        $contact->phones()->createMany($phones);
        return ContactResource::make($contact);
    }

    public function formatPhoneToSearch(string $phone): string
    {
        return preg_replace(['/\D/', '/^[78]/'], ['', '+7'], $phone);
    }

    private function findByPhones(array $phones): Collection
    {
        return Phone::whereIn('phone', array_map(fn($item) => $this->formatPhoneToSearch($item), $phones))->get();
    }
}
