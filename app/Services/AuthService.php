<?php

namespace App\Services;

use App\Models\Setting\MenuAccess;
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

        $user = $this->authRepository->findByNIK($credentials['nik'])->load('role.menu.menu.parent');

        $menuAccess = MenuAccess::getSlugsFromCollection($user->role->menu);

        return [
            'access_token'  => $token,
            'token_type'    => 'bearer',
            'expires_in'    => now()->addSeconds(Auth::factory()->getTTL() * 60)->timestamp,
            'user'          => Auth::user(),
            'role'          => $user->role->slug,
            'menu_access'   => $menuAccess
        ];
    }
}
