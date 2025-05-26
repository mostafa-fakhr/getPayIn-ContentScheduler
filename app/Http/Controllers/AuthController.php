<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{

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
