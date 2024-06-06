<?php

namespace App\Exceptions\Product;

use Exception;

class ProductNotFoundValiadationException extends Exception
{
    public function render()
    {
        return redirect()->back()->withErrors('Ошибка: Данный товар не найден');
    }
}
