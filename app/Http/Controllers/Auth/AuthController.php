<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Mappers\Auth\AuthDataMapper;
use App\Http\Requests\Auth\AuthRequest;
use App\Repository\User\UserRepository;
use App\Services\Auth\AuthManager;

class AuthController extends Controller
{
    private AuthManager $authManager;
    private AuthDataMapper $authDataMapper;
    private UserRepository $userRepository;

    public function __construct(
        AuthManager $authManager,
        AuthDataMapper $authDataMapper,
        UserRepository $userRepository,
    )
    {
        $this->authManager = $authManager;
        $this->authDataMapper = $authDataMapper;
        $this->userRepository = $userRepository;
    }
    public function login()
    {
        return view('v1.auth.login');
    }
    public function auth(AuthRequest $request)
    {
        $loginData = $this->authDataMapper->mapFromRequestToNormalized($request);
        $credentials = $this->authManager->getCredentials($loginData);
        $checkUser = $this->userRepository->getByUserNameOrEmail($loginData->username);

        if(empty($checkUser))
        {
            return redirect()->back()->withErrors('Отказано в доступе');
        }
        return redirect()->route('login')->withErrors(['auth' => 'Неверный логин или пароль']);
    }

}
