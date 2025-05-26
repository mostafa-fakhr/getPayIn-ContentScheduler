<?php

namespace App\Repositories;

use App\Models\Platform;

class PlatformRepository
{
    public function getAllPlatforms()
    {
        return Platform::all();
    }
}
