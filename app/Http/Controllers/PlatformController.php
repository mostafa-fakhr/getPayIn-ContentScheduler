<?php

namespace App\Http\Controllers;

use App\Services\PlatformService;
use App\Http\Requests\GetAllPlatformsRequest;
use Illuminate\Http\Request;

class PlatformController extends Controller
{
    protected PlatformService $platformService;

    public function __construct(PlatformService $platformService)
    {
        $this->platformService = $platformService;
    }

    public function getAllPlatforms(GetAllPlatformsRequest $request)
    {
        $platforms = $this->platformService->getAllPlatforms();
        return response()->json($platforms);
    }
}
