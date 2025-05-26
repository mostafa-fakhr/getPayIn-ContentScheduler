<?php

namespace App\Enums;

enum PostPlatformStatus: int
{
    case Pending = 1;
    case Posted = 2;
    case Failed = 3;
}
