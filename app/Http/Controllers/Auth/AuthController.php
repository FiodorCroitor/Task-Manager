<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\User\UserDuplicatedMailException;
use App\Exceptions\User\UserDuplicatedMailValidationException;
use App\Http\Controllers\Controller;
use App\Http\Mappers\Auth\AuthDataMapper;
use App\Http\Mappers\User\UserDataMapper;
use App\Http\Requests\Auth\AuthRequest;
use App\Http\Requests\User\UserRequest;
use App\Models\User;
use App\Repository\User\UserRepository;
use App\Services\Auth\AuthManager;
use App\Services\User\UserManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{


    public function __construct(
        public readonly AuthManager    $authManager,
        public readonly AuthDataMapper $authDataMapper,
        public readonly UserRepository $userRepository,
        public readonly UserDataMapper $userDataMapper,
        public readonly UserManager $userManager,
    )
    {
    }
    public function login()
    {
        return view('v1.auth.login');
    }



    public function auth(AuthRequest $request)
    {
        $authData = $this->authDataMapper->mapFromRequestToNormalized($request);
        $credentials = $this->authManager->getCredentials($authData);
        $checkedUser = $this->userRepository->getByEmail($authData->email);

        if (empty($checkedUser)) {
            return Redirect::back()->withErrors(['role.permissions' => 'Отказано в доступе']);
        }
        if (Auth::guard('web')->attempt($credentials)) {
            $user = Auth::guard('web')->user();

            return redirect()->route('dashboard.index');
        }

        return redirect()->route('login')->withErrors(['auth' => 'Неверный логин или пароль']);
    }

    public function logout()
    {
        Auth::guard('web')->logout();

        return redirect()->route('login');
    }

}
