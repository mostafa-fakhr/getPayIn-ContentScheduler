<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Platform;
use App\Models\UserPlatform;

class UserPlatformRepository
{
    public function getUserPlatforms($userId)
    {
        return User::findOrFail($userId)->platforms;
    }

    public function togglePlatform($userId, $platformId, $isActive)
    {
        $user = User::findOrFail($userId);
        $user->platforms()->updateExistingPivot($platformId, ['is_active' => $isActive]);
        return $user->platforms()->wherePivot('platform_id', $platformId)->first();
    }

    public function activateAllPlatformsForUser($userId)
    {
        $user = User::findOrFail($userId);
        $platformIds = Platform::pluck('id')->toArray();
        $syncData = [];
        foreach ($platformIds as $pid) {
            $syncData[$pid] = ['is_active' => true];
        }
        $user->platforms()->syncWithoutDetaching($syncData);
        return $user->platforms;
    }
    public function createDefaultUserPlatforms($userId)
    {
        $platforms = Platform::all(['id']);

        $data = [];
        foreach ($platforms as $platform) {
            $data[] = [
                'user_id' => $userId,
                'platform_id' => $platform->id,
                'is_active' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        UserPlatform::insert($data);
    }
}
