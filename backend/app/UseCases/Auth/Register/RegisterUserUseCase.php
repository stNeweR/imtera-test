<?php

namespace App\UseCases\Auth\Register;

use App\Repositories\UserRepository;

final readonly class RegisterUserUseCase
{
    public function __construct(
        private UserRepository $userRepository
    ) {}

    public function execute(RegisterUserPayload $payload): RegisterUserResultDTO
    {
        $user = $this->userRepository->create(
            name: $payload->getName(),
            email: $payload->getEmail(),
            password: $payload->getPassword(),
        );

        $token = $user->createToken('auth_token')->plainTextToken;

        return new RegisterUserResultDTO(
            message: __('auth.success_registered'),
            user: $user,
            token: $token,
        );
    }
}
