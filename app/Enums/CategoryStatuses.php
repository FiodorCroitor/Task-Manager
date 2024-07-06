<?php

declare(strict_types=1);

namespace App\Enums;

enum CategoryStatuses: string
{
    case Inactive = 'неактивно';
    case Active = 'активно';

    public static function getAll(): array
    {
        return [
            self::Inactive,
            self::Active,
        ];
    }
}
