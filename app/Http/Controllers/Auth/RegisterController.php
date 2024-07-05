<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\User\UserDuplicatedMailException;
use App\Exceptions\User\UserDuplicatedMailValidationException;
use App\Http\Controllers\Controller;
use App\Http\Mappers\User\UserDataMapper;
use App\Http\Requests\User\UserRequest;
use App\Services\User\UserManager;

class RegisterController extends Controller
{

    public function __construct(
        public readonly UserManager    $userManager,
        public readonly UserDataMapper $userDataMapper,
    )
    {
    }

    public function index()
    {
        return view('v1.auth.register');
    }


    public function store(UserRequest $request)
    {
        $userData = $this->userDataMapper->mapFromRequestToNormalized($request);
        try {
            $this->userManager->store($userData);

            return to_route('login')->with('Аккаунт успешно создан');
        } catch (UserDuplicatedMailException $e) {
            throw new UserDuplicatedMailValidationException();
        }
    }

}
