<?php

namespace App\Exceptions\Prepayment;

use Exception;
use Illuminate\Support\Facades\Redirect;

class PrepaymentNotFoundValidationException extends Exception
{
    public function render($request)
    {
        return Redirect::back()->withErrors(['Ошибка: Выплата не найдена']);
    }
}
