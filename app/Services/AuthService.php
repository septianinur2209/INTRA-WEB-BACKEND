<?php

namespace App\Services;

use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Auth;
use Exception;

class AuthService
{
    protected AuthRepository $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login(array $credentials)
    {
        if (! $token = Auth::attempt($credentials)) {
            throw new Exception('Email atau password salah');
        }

        return [
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => Auth::factory()->getTTL() * 60,
            'user'         => Auth::user()
        ];
    }
}
