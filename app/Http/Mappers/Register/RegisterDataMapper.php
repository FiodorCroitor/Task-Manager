<?php

namespace App\Http\Mappers\Register;

use App\Data\Register\RegisterData;
use App\Http\Requests\Register\RegisterRequest;

class RegisterDataMapper
{
      public function mapFromRequestToNormalized(RegisterRequest $request): RegisterData
      {
          return new RegisterData(
              $request->first_name,
              $request->last_name,
              $request->email,
              $request->password,
          );
      }
}
