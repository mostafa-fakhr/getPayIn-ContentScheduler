<?php

namespace App\Http\Controllers;

use App\Services\UserPlatformService;
use App\Http\Requests\ToggleUserPlatformRequest;
use Illuminate\Http\Request;

class UserPlatformController extends Controller
{
    protected UserPlatformService $userPlatformService;

    public function __construct(UserPlatformService $userPlatformService)
    {
        $this->userPlatformService = $userPlatformService;
    }

    public function getUserPlatforms($userId)
    {
        $platforms = $this->userPlatformService->getUserPlatforms($userId);
        return response()->json($platforms);
    }

    public function togglePlatform(ToggleUserPlatformRequest $request, $userId)
    {
        $platformId = $request->input('platform_id');
        $isActive = $request->input('is_active');
        $platform = $this->userPlatformService->togglePlatform($userId, $platformId, $isActive);
        return response()->json($platform);
    }
}
