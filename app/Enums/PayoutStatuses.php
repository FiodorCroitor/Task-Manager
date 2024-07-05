<?php

declare(strict_types=1);

namespace App\Enums;

enum PayoutStatuses: string
{
    case ACTIVE = 'Активно';
    case INACTIVE = 'Неактивно';
    case FINISHED = 'Закончено/Ожидание оплаты';


    public static function getAll(): array
    {
        return [
            self::ACTIVE,
            self::INACTIVE,
            self::FINISHED,
        ];
    }
}
