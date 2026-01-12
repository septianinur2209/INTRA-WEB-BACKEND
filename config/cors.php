<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'], // semua method diizinkan
    'allowed_origins' => ['http://127.0.0.1:8001', 'http://localhost:8001','http://127.0.0.1:3000', 'http://localhost:3000'], // origin frontend
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'], // semua header diizinkan
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true, // karena pakai cookie/JWT
];
