<?php

namespace App\Http\Requests\Register;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 */

class RegisterRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'first_name' =>[ 'required|string|max:255'],
            'last_name' => ['required|string|max:255'],
            'email' => ['required|string|email|max:255|unique:users'],
            'password' => ['required|string|min:8|confirmed'],
        ];
    }
}
