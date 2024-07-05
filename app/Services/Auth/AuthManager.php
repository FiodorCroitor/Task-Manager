<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Data\Auth\AuthData;


final class AuthManager
{
    private const string EMAIL_ATTRIBUTE = 'email';
    private const string NICKNAME_ATTRIBUTE = 'name';

    public function getCredentials(AuthData $authData): array
    {
        $username = $authData->email;
        $password = $authData->password;
        $loginFieldName = $this->getLoginFieldNameByUsername($username);
        return [
            $loginFieldName => $username,
            'password' => $password,
        ];
    }

    private function getLoginFieldNameByUsername(string $username): string
    {
        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            return self::EMAIL_ATTRIBUTE;
        }
        return self::NICKNAME_ATTRIBUTE;
    }
}
