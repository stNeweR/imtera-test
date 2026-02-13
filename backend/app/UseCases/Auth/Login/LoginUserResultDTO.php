<?php

declare(strict_types=1);

namespace App\UseCases\Auth\Login;

use App\DTO\BaseDTO;

final class LoginUserResultDTO extends BaseDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $email,
        public readonly string $token,
    ) {}

    protected function getRequiredFields(): array
    {
        return ['id', 'name', 'email', 'token'];
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['name'],
            $data['email'],
            $data['token'],
        );
    }

    public function toArray(): array
    {
        return [
            'user' => [
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
            ],
            'token' => $this->token,
        ];
    }
}
