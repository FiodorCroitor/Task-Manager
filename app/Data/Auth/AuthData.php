<?php

namespace App\Data\Auth;
/**
 * @property string email
 * @property string password
 * ,
 */
class AuthData
{
    public string $email;
    public string $password;


    public function __construct(
        string $email,
        string $password,


    )
    {
        $this->email = $email;
        $this->password = $password;
    }
}
