<?php

namespace App\Services;

use App\Repositories\UserPlatformRepository;

class UserPlatformService
{
    protected UserPlatformRepository $userPlatformRepository;

    public function __construct(UserPlatformRepository $userPlatformRepository)
    {
        $this->userPlatformRepository = $userPlatformRepository;
    }

    public function getUserPlatforms($userId)
    {
        return $this->userPlatformRepository->getUserPlatforms($userId);
    }

    public function togglePlatform($userId, $platformId, $isActive)
    {
        return $this->userPlatformRepository->togglePlatform($userId, $platformId, $isActive);
    }

    public function activateAllPlatformsForUser($userId)
    {
        return $this->userPlatformRepository->activateAllPlatformsForUser($userId);
    }
}
