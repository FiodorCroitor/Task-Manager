<?php

namespace App\Services\User;

use App\Data\User\UserData;
use App\Exceptions\User\DuplicatedUserEmailException;
use App\Exceptions\User\UserDuplicatedMailException;
use App\Exceptions\User\UserDuplicatedMailValidationException;
use App\Exceptions\User\UserNotFoundException;
use App\Http\Requests\User\UserDeleteRequest;
use App\Http\Requests\User\UserRequest;
use App\Models\Category;
use App\Models\Profile;
use App\Models\User;
use App\Repository\User\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


 class UserManager
{

    public function __construct(
        public readonly UserRepository $userRepository,
    )
    {
    }

    public function store(UserData $userData): User
    {

        $existedUser = $this->userRepository->getFirstByEmail($userData->email);
        if ($existedUser !== null) {
            throw new UserDuplicatedMailException();
        }

        $password = Hash::make(Str::random(12));

        if ($userData->password !== null) {
            $password = Hash::make($userData->password);
        }


        $name = $userData->first_name . '-' . $userData->last_name;
        $user = User::create([
            'name' => $name,
            'email' => $userData->email,
            'password' => $password,
        ]);

        $user->save();

        Profile::create([
            'first_name' => $userData->first_name,
            'last_name' => $userData->last_name,
            'user_id' => $user->id,
        ]);

        return $user;
    }

    public function update(User $user,UserData $userData): void
    {
        $existedUser = $this->userRepository->getById($user->id);

        if ($existedUser === null) {
            throw new UserNotFoundException();
        }
        if ($userData->email !== null && $userData->email !== $user->email) {
            $existedUserByEmail = $this->userRepository->getFirstByEmail($userData->email);

            if ($existedUserByEmail !== null) {
                throw new UserDuplicatedMailValidationException();
            }

        }


        $user->update([

            'email' => $userData->email,
            'password' => $userData->password,
        ]);

        $user->save();

       $user->profile()->update([
            'first_name' => $userData->first_name,
            'last_name' => $userData->last_name,
            'user_id' => $user->id,
        ]);
    }

    public function delete(User $user): void
    {
        $user->delete();
    }
}
