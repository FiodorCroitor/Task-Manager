<?php

namespace App\Http\Controllers\Register;

use App\Exceptions\User\UserDuplicatedMailException;
use App\Exceptions\User\UserDuplicatedMailValidationException;
use App\Http\Controllers\Controller;
use App\Http\Mappers\User\UserDataMapper;
use App\Http\Requests\Register\RegisterRequest;
use App\Http\Requests\User\UserRequest;
use App\Repository\User\UserRepository;
use App\Services\User\UserManager;

class RegisterController extends Controller
{
    public function __construct(
        public readonly UserRepository $userRepository,
        public readonly UserManager    $userManager,
        public readonly UserDataMapper $userDataMapper,
    )
    {

    }

    public function index()
    {
        return view('register.index');
    }

    public function store(UserRequest $request)
    {
        $userData = $this->userDataMapper->mapFromRequestToNormalized($request);
        try {
            $this->userManager->store($request , $userData);

            return redirect()->route('login')->with('success', 'User created successfully');
        } catch (UserDuplicatedMailException $e) {
            throw  new UserDuplicatedMailValidationException();
        }
    }
}
