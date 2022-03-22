<?php


namespace App\Repositories;


use App\Exceptions\CreateDuplicateModelException;
use App\Http\Requests\ContactSearchRequest;
use App\Models\Contact;
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

    public function create(array $fields)
    {
        if ($this->findByPhone($fields['phone'])->isNotEmpty()) {
            throw new CreateDuplicateModelException('Create contact duplicate phone number');
        }
        return Contact::create($fields);
    }

    public function formatPhoneToSearch(string $phone): string
    {
        return preg_replace(['/\D/', '/^[78]/'], ['', '+7'], $phone);
    }
}
