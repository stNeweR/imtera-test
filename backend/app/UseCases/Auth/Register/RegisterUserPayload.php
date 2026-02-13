<?php

namespace App\UseCases\Auth\Register;

use App\DTO\BaseDTO;

final class RegisterUserPayload extends BaseDTO
{
    public function __construct(
        private readonly string $name,
        private readonly string $email,
        private readonly string $password,
    ) {}

    protected function getRequiredFields(): array
    {
        return ['name', 'email', 'password'];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
