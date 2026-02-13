<?php

declare(strict_types=1);

namespace App\UseCases\Auth\Login;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

final readonly class LoginUserUseCase
{
    public function __construct(
        private UserRepository $userRepository
    ) {}

    public function execute(LoginUserPayload $payload): LoginUserResultDTO
    {
        $user = $this->userRepository->findByEmail($payload->email);

        if (! $user || ! Hash::check($payload->password, $user->password)) {
            throw new \Illuminate\Auth\AuthenticationException('Invalid credentials');
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return new LoginUserResultDTO(
            $user->id,
            $user->name,
            $user->email,
            $token
        );
    }
}
