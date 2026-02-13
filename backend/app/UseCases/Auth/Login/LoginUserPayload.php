<?php

declare(strict_types=1);

namespace App\UseCases\Auth\Login;

use App\DTO\BaseDTO;

final class LoginUserPayload extends BaseDTO
{
    public function __construct(
        public readonly string $email,
        public readonly string $password,
    ) {}

    protected function getRequiredFields(): array
    {
        return ['email', 'password'];
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['email'],
            $data['password'],
        );
    }
}
