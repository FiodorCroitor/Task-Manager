<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Mappers\Auth\AuthDataMapper;
use App\Http\Requests\Auth\AuthRequest;
use App\Repository\User\UserRepository;
use App\Services\Auth\AuthManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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
        $authData = $this->authDataMapper->mapFromRequestToNormalized($request);
        $credentials = $this->authManager->getCredentials($authData);
        $checkedUser = $this->userRepository->getByUsernameOrEmail($authData->email);

        if (empty($checkedUser)) {
            return Redirect::back()->withErrors(['role.permissions' => 'Отказано в доступе']);
        }
        if (Auth::guard('web')->attempt($credentials)) {
            $user = Auth::guard('web')->user();

            return redirect()->route('dashboard.index');
        }

        return redirect()->route('login')->withErrors(['auth' => 'Неверный логин или пароль']);
    }

}
