<?php

namespace App\Constants;

use Illuminate\Http\Response;


/**
 * This class contains error codes returned by the api with their respective messages 
 * and http response codes
 *
 */
class Error
{
    const USER_NOT_FOUND = 1;
    const UNAUTHORIZED_ACCESS = 2;
    const POST_NOT_FOUND = 3;

    const MSG = array(
        self::USER_NOT_FOUND => 'User not found',
        self::UNAUTHORIZED_ACCESS => 'Unauthorized access',
        self::POST_NOT_FOUND => 'Post not found'
    );

    const HTTP_CODE = array(
        self::USER_NOT_FOUND => Response::HTTP_NOT_FOUND,
        self::UNAUTHORIZED_ACCESS => Response::HTTP_UNAUTHORIZED,
        self::POST_NOT_FOUND => Response::HTTP_NOT_FOUND
    );
}
