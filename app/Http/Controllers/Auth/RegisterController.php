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

    public function index()
    {
        return view('v1.auth.register');
    }


}
