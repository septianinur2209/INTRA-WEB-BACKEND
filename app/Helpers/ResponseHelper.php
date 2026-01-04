<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

class ResponseHelper
{
    // Fungsi untuk response sukses
    public static function success($code, $message, $data)
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'error' => false,
            'data' => $data,
        ], $code);
    }

    // Fungsi untuk response error dan logging
    public static function error($code, $exception, $message = 'Internal Server Error')
    {
        // Log error lengkap
        Log::error("Error occurred in " . $exception->getFile() .
            " at line " . $exception->getLine() .
            " with message: " . $exception->getMessage());

        return response()->json([
            'code' => $code,
            'message' => $message,
            'error' => true,
            'data' => null,
        ], $code);
    }
}
