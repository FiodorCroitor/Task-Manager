<?php

namespace App\Services\User;

use App\Data\User\UserData;
use App\Exceptions\User\UserDuplicatedMailException;
use App\Exceptions\User\UserNotFoundException;
use App\Http\Requests\User\UserDeleteRequest;
use App\Http\Requests\User\UserRequest;
use App\Models\User;
use App\Repository\User\UserRepository;

class UserManager
{
    public UserRepository $userRepository;
    public UserData $userData;

    public function __construct(
        UserRepository $userRepository,
        UserData       $userData
    )
    {
        $this->userRepository = $userRepository;
        $this->userData = $userData;
    }

    public function store(UserRequest $request,UserData $userData): User
    {
        $existedUser = $this->userRepository->getFirstByEmail($request->email);
        if ($existedUser !== null) {
            throw new UserDuplicatedMailException();
        }

        $name = $userData->first_name . "-" . $userData->last_name;
        $user = User::create([
            'name' => $name,
            'email' => $userData->email,
            'password' => $userData->password,
        ]);
        $user->save();
        $profile = Profile::create([
            'user_id' => $user->id,
            'first_name' => $userData->first_name,
            'last_name' => $userData->last_name,
        ]);
     return $user;
    }
    public function update(User $user , UserData $userData): bool
    {
        $existedUser = $this->userRepository->getById($user->id);
        if ($existedUser !== null) {
            throw new UserDuplicatedMailException();
        }

        $name = $userData->first_name . " " . $userData->last_name;

        $user = User::update([
            'name' => $name,
            'email' => $userData->email,
            'password' => $userData->password,
        ]);
        $user->save();


        $profile = Profile::update([
            'user_id' => $user->id,
            'first_name' => $userData->first_name,
            'last_name' => $userData->last_name,
        ]);
        return $user;
    }
    public function delete(UserDeleteRequest $request): void
    {
        $userId = (int)$request->user_id;

        $user = $this->userRepository->getById($userId);


        if ($user === null) {
            throw new UserNotFoundException();
        }

        $user->delete();
    }
}
