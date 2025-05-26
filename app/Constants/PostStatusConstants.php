<?php

namespace App\Constants;

class PostStatusConstants
{
    public const DRAFT = 1;
    public const SCHEDULED = 2;
    public const PUBLISHED = 3;

    public const POST_STATUS_CONSTANTS_ARR = [
        self::DRAFT,
        self::SCHEDULED,
        self::PUBLISHED,
    ];
}
