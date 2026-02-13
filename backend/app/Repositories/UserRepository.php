<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

final class UserRepository
{
    public function create(string $name, string $email, string $password): User
    {
        return User::query()->create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);
    }
}
