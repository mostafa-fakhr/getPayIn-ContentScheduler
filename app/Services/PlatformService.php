<?php

namespace App\Services;

use App\Repositories\PlatformRepository;

class PlatformService
{
    protected PlatformRepository $platformRepository;

    public function __construct(PlatformRepository $platformRepository)
    {
        $this->platformRepository = $platformRepository;
    }

    public function getAllPlatforms()
    {
        return $this->platformRepository->getAllPlatforms();
    }
}
