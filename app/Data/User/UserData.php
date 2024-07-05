<?php

namespace App\Data\User;
/**
 * @property string $password
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 */
class UserData
{
    public function __construct(
        public readonly string $email,
        public readonly string $password,
        public readonly string $first_name,
        public readonly string $last_name,
    )
    {
    }
}
