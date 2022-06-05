<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * Login user
     * @param LoginRequest $request
     * @return JsonResponse
     * @throws \App\Exceptions\InvalidUserCredentialsException
     */
    public function login(LoginRequest $request): JsonResponse
    {
        return response()->json([
            'token' => $request->getBearerToken()
        ]);
    }
}
