<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int $product_id
 */

class ProductDeleteRequest extends FormRequest
{
    public mixed $id;

    public function rules(): array
    {
        return [
            'product_id' => ['required', 'integer'],
        ];
    }
}
