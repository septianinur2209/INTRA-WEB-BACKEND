<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(AuthRequest $request)
    {
        try {
            $result = $this->authService->login($request->only('nik', 'password'));

            return response()->json([
                'success' => true,
                'data'    => $result
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 401);
        }
    }

    public function me()
    {
        return response()->json(auth('api')->user());
    }

    public function logout()
    {
        Auth::guard('api')->logout();

        return response()->json([
            'message' => 'Logout berhasil'
        ]);
    }
}
