<?php

namespace App\Http\Controllers;

use App\Constants\MethodParameter;
use App\Http\Requests\DeleteUserRequest;
use App\Http\Requests\GetUserByIdRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserLoginRequest;
use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function createUser(RegisterRequest $request)
    {
        $data = $this->userService->createUser($request->validated());

        return response()->json($data, 201);
    }

    public function userLogin(UserLoginRequest $request)
    {
        $data = $this->userService->userLogin($request->input('email'), $request->input('password'));

        return response()->json($data, 201);
    }

    public function getUserById(GetUserByIdRequest $request, $userId)
    {

        $data = $this->userService->getUserById($userId);

        return response()->json($data, 201);
    }

    public function updateUser(UpdateUserRequest $request, $userId)
    {
        $optionsArr = array(
            MethodParameter::USERNAME => $request->input('username'),
            MethodParameter::EMAIL => $request->input('email'),
            MethodParameter::PASSWORD => $request->input('password'),
        );
        $data = $this->userService->updateUser($userId, $optionsArr);

        return response()->json($data, 200);
    }

    public function deleteUser(DeleteUserRequest $request, $userId)
    {
        $this->userService->deleteUser($userId);

        return response()->json(['message' => 'User deleted successfully'], 200);
    }
}
