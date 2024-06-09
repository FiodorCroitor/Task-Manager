<?php

namespace App\Data\Auth;
/**
 * @property string username,
 * @property string password,
 * ,
 */
class AuthData
{
    public string $username;
    public string $password;


    public function __construct(
        string $username,
        string $password,


    )
    {
        $this->username = $username;
        $this->password = $password;
    }
}
