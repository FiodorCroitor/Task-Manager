<?php

namespace App\Data\User;
/**
 * @property string $name,
 * @property string $password,
 * @property string $email,
 * @property string $first_name
 * @property string $last_name
 */
class UserData
{
    public string $name;
    public string $password;
    public ?string $email;
    public string $first_name;
    public string $last_name;

    public function __construct(
        string  $name,
        string  $password,
        ?string $email,
        string  $first_name,
        string $last_name,
    )
    {
        $this->name = $name;
        $this->password = $password;
        $this->email = $email;
        $this->first_name = $first_name;
        $this->last_name = $last_name;

    }
}
