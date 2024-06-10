<?php

namespace App\Http\Mappers\Auth;

use App\Data\Auth\AuthData;
use App\Http\Requests\Auth\AuthRequest;

class AuthDataMapper
{
    public function mapFromRequestToNormalized(AuthRequest $request): AuthData
    {
        return new AuthData(
            $request->email,
            $request->password,
    );
    }
}
