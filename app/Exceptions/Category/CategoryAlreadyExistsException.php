<?php

namespace App\Exceptions\Category;

use Exception;

class CategoryAlreadyExistsException extends Exception
{
    public function render($request)
    {
        return redirect()->back()->withErrors('Ошибка: Данная категория уже существует');
    }
}
