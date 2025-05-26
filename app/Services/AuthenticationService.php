<?php

namespace App\Services;

use App\Constants\Error;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;

class AuthenticationService
{
    public function generateToken(User $user): string
    {
        return $user->createToken('api-token')->plainTextToken;
    }
}
