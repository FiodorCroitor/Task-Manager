<?php

declare(strict_types=1);

namespace App\Enums;

enum PayoutStatuses: string
{
    case ACTIVE = 'активно';
    case INACTIVE = 'неактивно';
    case FINISHED = 'закончено/ожидание оплаты';


    public static function getAll(): array
    {
        return [
            self::ACTIVE,
            self::INACTIVE,
            self::FINISHED,
        ];
    }
}
