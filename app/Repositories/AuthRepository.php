<?php

namespace App\Repositories;

use App\Models\User;

class AuthRepository
{
    public function findByNIK(string $nik)
    {
        return User::where('nik', $nik)->first();
    }
}
