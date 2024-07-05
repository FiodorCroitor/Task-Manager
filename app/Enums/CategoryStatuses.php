<?php

declare(strict_types=1);

namespace App\Enums;

enum CategoryStatuses: string
{
    case Inactive = 'inactive';
    case Active = 'active';

    public static function getAll(): array
    {
        return [
            self::Inactive,
            self::Active,
        ];
    }
}
