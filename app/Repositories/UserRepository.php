<?php

namespace App\Repositories;

use App\Constants\MethodParameter;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function createUser($data)
    {
        return User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function findUserByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    public function getUserById($userId)
    {
        return User::find($userId);
    }

    public function updateUser($userId, array $optionsArr)
    {
        $user = $this->getUserById($userId);
        if (isset($optionsArr[MethodParameter::USERNAME])) {
            $user->name = $optionsArr[MethodParameter::USERNAME];
        }
        if (isset($optionsArr[MethodParameter::EMAIL])) {
            $user->email = $optionsArr[MethodParameter::EMAIL];
        }
        if (isset($optionsArr[MethodParameter::PASSWORD])) {
            $user->password = Hash::make($optionsArr[MethodParameter::PASSWORD]);
        }

        $user->save();

        return $user;
    }

    public function deleteUser($userId)
    {
        $user = $this->getUserById($userId);

        $user->delete();
        return $user;
    }
}
