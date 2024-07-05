<?php

declare(strict_types=1);

namespace App\Enums;


enum ProductStatuses:string {
    case ACTIVE = 'Активно';
    case INACTIVE = 'Неактивно';
    case PAUSED = 'Приостановлено';
    case CANCELED = 'Отменено';
    case FINISHED = 'Закончено';


    public static function   getAll(): array
   {
        return [
            self::ACTIVE,
            self::INACTIVE,
            self::CANCELED,
            self::PAUSED,
            self::FINISHED,
        ];
    }
}
