<?php

namespace App\Enums;

enum PostStatus: int
{
    case Draft = 1;
    case Scheduled = 2;
    case Published = 3;
}
