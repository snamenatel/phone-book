<?php


namespace App\Repositories;


use App\Exceptions\CreateDuplicateModelException;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function findByEmail(string $email): Collection
    {
        return User::where('email', $email)->get();
    }

    public function create(array $fields)
    {
        if ($this->findByEmail($fields['email'])->isNotEmpty()) {
           throw new CreateDuplicateModelException('Create user with existing email');
        }

        $fields['password'] = Hash::make($fields['password']);
        return User::create($fields);
    }
}