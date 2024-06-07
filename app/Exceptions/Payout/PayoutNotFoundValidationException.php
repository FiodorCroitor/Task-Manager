<?php

namespace App\Exceptions\Payout;

use Exception;
use Illuminate\Support\Facades\Redirect;

class PayoutNotFoundValidationException extends Exception
{
    public function render($request)
    {
        return Redirect::back()->withErrors('Ошибка: Payout не найден');
    }
}
