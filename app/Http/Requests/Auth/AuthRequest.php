<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{

    public function rules(): array
    {
        return [
             'username' => ['required' , 'string'],
            'password' => ['required'  , 'string'],
        ];
    }
}
