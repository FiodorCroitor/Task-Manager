<?php

namespace App\Data\Auth;
/**
 * @property string email
 * @property string password
 * ,
 */
class AuthData
{
    public function __construct(
        public readonly string $email,
        public readonly string $password,
    )
    {
    }
}
