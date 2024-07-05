<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductDeleteMediaRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => ['integer', 'required']
        ];
    }
}
