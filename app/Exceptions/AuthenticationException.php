<?php

/**
 * This exception is thrown in case of user errors
 *
 */

namespace App\Exceptions;

use App\Constants\Error;

class AuthenticationException extends AppException
{
    public $errors;

    public function __construct($code, $errors = null)
    {
        parent::__construct($code);
        $this->errors = $errors;
    }
}
