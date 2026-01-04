<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class JwtMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {
            // Pastikan request mengirim token
            $token = $request->bearerToken();
            
            if (!$token) {
                return response()->json(['message' => 'Token not provided'], 401);
            }

            // Authenticate token
            $user = JWTAuth::parseToken()->authenticate();

            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }

            // set user di request
            // $request->user = $user;

        } catch (JWTException $e) {
            return response()->json(['message' => 'Unauthorized', 'error' => $e->getMessage()], 401);
        }

        return $next($request);
    }
}
