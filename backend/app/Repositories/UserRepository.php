<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;

final readonly class UserRepository
{
    /**
     * @throws ModelNotFoundException
     */
    public function findByEmail(string $email): User
    {
        return User::query()->where('email', $email)->first();
    }

    public function create(string $name, string $email, string $password): User
    {
        return User::query()->create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);
    }
}
