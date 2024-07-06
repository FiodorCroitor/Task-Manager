<?php

declare(strict_types=1);

namespace App\Enums;


enum ProductStatuses:string {
    case ACTIVE = 'активно';
    case INACTIVE = 'неактивно';
    case PAUSED = 'приостановлено';
    case CANCELED = 'отменено';
    case FINISHED = 'закончено';


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
