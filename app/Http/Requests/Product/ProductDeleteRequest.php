<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductDeleteRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'product_id' => ['required', 'integer'],
        ];
    }
}
