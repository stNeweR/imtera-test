<?php

namespace App\UseCases\Auth\Register;

use App\DTO\BaseDTO;
use App\Models\User;

final class RegisterUserResultDTO extends BaseDTO
{
    public function __construct(
        public readonly string $message,
        public readonly User $user,
        public readonly string $token,
    ) {}

    protected function getRequiredFields(): array
    {
        return ['message', 'user', 'token'];
    }
}
