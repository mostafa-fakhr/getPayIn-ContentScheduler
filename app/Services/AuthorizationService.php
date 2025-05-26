<?php

namespace App\Services;

use App\Constants\Error;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;

class AuthorizationService
{
    public function isUserOfType($user, $class, $forceReturn = false)
    {
        if ($user instanceof $class) {
            return true;
        } elseif ($forceReturn) {
            return false;
        }
        throw new AuthorizationException(Error::UNAUTHORIZED_ACCESS);
    }
}
