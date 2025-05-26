<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    // public function __construct(protected UserService $userService) {}

    // public function login(Request $request): JsonResponse
    // {

    //     $data = $this->userService->login($request->email, $request->password);

    //     return response()->json($data);
    // }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out']);
    }

    public function me(Request $request): JsonResponse
    {
        return response()->json($request->user());
    }
}
