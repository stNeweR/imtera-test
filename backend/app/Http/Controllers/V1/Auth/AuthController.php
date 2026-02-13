<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Auth\RegisterRequest;
use App\UseCases\Auth\Register\RegisterUserPayload;
use App\UseCases\Auth\Register\RegisterUserUseCase;
use Illuminate\Http\JsonResponse;

final class AuthController extends Controller
{
    public function login() {}

    /**
     * @throws \ReflectionException
     */
    public function register(RegisterRequest $request, RegisterUserUseCase $useCase): JsonResponse
    {
        $data = $request->validated();

        $result = $useCase->execute(RegisterUserPayload::fromArray($data));

        return response()->json($result->toArray(), 201);
    }
}
