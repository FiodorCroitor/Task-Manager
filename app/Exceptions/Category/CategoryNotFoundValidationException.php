<?php

namespace App\Exceptions\Category;

use Exception;

class CategoryNotFoundValidationException extends Exception
{
    public function render($request)
    {
        return redirect()->back()->withErrors('Ошибка: Данная категория не найдена');
    }
}
