<?php

namespace App\Services;

use App\Constants\Error;
use App\Exceptions\AuthenticationException;
use App\Repositories\UserPlatformRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserService
{
    protected UserRepository $userRepository;
    protected UserPlatformRepository $userPlatformRepository;
    protected AuthenticationService $authService;

    public function __construct(UserRepository $userRepository, AuthenticationService $authService, UserPlatformRepository $userPlatformRepository)
    {
        $this->userRepository = $userRepository;
        $this->authService = $authService;
        $this->userPlatformRepository = $userPlatformRepository;
    }

    public function createUser($data)
    {
        $user = $this->userRepository->createUser($data);
        $this->userPlatformRepository->createDefaultUserPlatforms($user->id);
        $token = $this->authService->generateToken($user);

        return ['user' => $user, 'token' => $token];
    }

    public function userLogin($email, $password)
    {
        $user = $this->userRepository->findUserByEmail($email);

        if (!$user || !Hash::check($password, $user->password)) {
            throw new AuthenticationException(Error::USER_NOT_FOUND);
        }

        $token = $this->authService->generateToken($user);

        return ['user' => $user, 'token' => $token];
    }

    public function getUserById($userId)
    {
        $user = $this->userRepository->getUserById($userId);

        if (is_null($user)) {
            throw new AuthenticationException(Error::USER_NOT_FOUND);
        }

        return $user;
    }

    public function updateUser($userId, $optionsArr)
    {
        $this->validateUserExists($userId);
        return $this->userRepository->updateUser($userId, $optionsArr);
    }

    public function deleteUser($userId)
    {
        $this->validateUserExists($userId);
        return $this->userRepository->deleteUser($userId);
    }

    public function validateUserExists($userId)
    {
        $user = $this->userRepository->getUserById($userId);
        if (is_null($user)) {
            throw new AuthenticationException(Error::USER_NOT_FOUND);
        }
    }
}
