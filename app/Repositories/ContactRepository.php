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

    public function show(int $id)
    {
        return Contact::with(['phones', 'author:id,name'])->findOrFail($id);
    }

    public function store(ContactStoreRequest $request): ContactResource
    {
        if ($this->findByPhones($request->phone)->isNotEmpty()) {
            throw new CreateDuplicateModelException('Create user with existing email');
        }

        $contact = Contact::create($request->only('name'));
        $this->storePhones($contact, $request->phone);
        return ContactResource::make($contact);
    }

    public function update(Request $request, int $id)
    {
        $changed = false;
        $contact = Contact::with(['phones'])->findOrFail($id);
        if ($request->name && $contact->name !== $request->name) {
            $contact->update(['name' => $request->name]);
            $changed = true;
        }

        if (count($request->input('phone', []))) {
            $contact->phones()->delete();
            $this->storePhones($contact, $request->phone);
            $changed = true;
        }

        return response()->json(['message' => $changed ? 'Контакт был изменен' : 'Нечего изменять']);
    }

    public function formatPhoneToSearch(string $phone): string
    {
        return preg_replace(['/\D/', '/^[78]/'], ['', '+7'], $phone);
    }

    private function storePhones(Contact $contact, array $phones)
    {
        $phones = collect($phones)
            ->map(fn($el) => ['phone' => $this->formatPhoneToSearch($el)])
            ->toArray();
        $contact->phones()->createMany($phones);
    }

    private function findByPhones(array $phones): Collection
    {
        return Phone::whereIn('phone', array_map(fn($item) => $this->formatPhoneToSearch($item), $phones))->get();
    }

    private function find(int $id): Contact
    {
        return Contact::with('phones')->find($id);
    }
}
