<?php

declare(strict_types=1);

namespace App\UseCases\Auth\Logout;

use Illuminate\Http\Request;

final class LogoutUserUseCase
{
    public function execute(Request $request): void
    {
        $request->user()->currentAccessToken()->delete();
    }
}
