<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Auth\LoginRequest;
use App\Http\Requests\V1\Auth\RegisterRequest;
use App\UseCases\Auth\Login\LoginUserPayload;
use App\UseCases\Auth\Login\LoginUserUseCase;
use App\UseCases\Auth\Logout\LogoutUserUseCase;
use App\UseCases\Auth\Register\RegisterUserPayload;
use App\UseCases\Auth\Register\RegisterUserUseCase;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use ReflectionException;

final class AuthController extends Controller
{
    /**
     * @throws AuthenticationException
     */
    public function login(LoginRequest $request, LoginUserUseCase $useCase): JsonResponse
    {
        $data = $request->validated();

        $result = $useCase->execute(LoginUserPayload::fromArray($data));

        return response()->json($result->toArray(), 200);
    }

    /**
     * @throws ReflectionException
     */
    public function register(RegisterRequest $request, RegisterUserUseCase $useCase): JsonResponse
    {
        $data = $request->validated();

        $result = $useCase->execute(RegisterUserPayload::fromArray($data));

        return response()->json($result->toArray(), 201);
    }

    public function logout(Request $request, LogoutUserUseCase $useCase): JsonResponse
    {
        $useCase->execute($request);

        return response()->json(['message' => 'Logged out successfully'], 200);
    }
}
