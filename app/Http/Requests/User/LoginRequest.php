<?php

namespace App\Http\Requests\User;

use App\Exceptions\InvalidUserCredentialsException;
use App\Http\Requests\ApiRequest;
use Illuminate\Support\Facades\Auth;

class LoginRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * @throws InvalidUserCredentialsException
     */
    public function getBearerToken(): string
    {
        if (!Auth::attempt($this->all())) {
            throw new InvalidUserCredentialsException();
        }

        return $this->user()->createToken('api')->plainTextToken;
    }
}
