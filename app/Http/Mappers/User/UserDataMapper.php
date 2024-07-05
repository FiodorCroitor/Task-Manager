<?php

namespace App\Http\Mappers\User;

use App\Data\User\UserData;
use App\Http\Requests\User\UserRequest;

final class UserDataMapper
{
    public function mapFromRequestToNormalized(UserRequest $request): UserData
    {
      return new UserData(

          $request->email,
          $request->password,
          $request->first_name,
          $request->last_name,
      );
    }
}
