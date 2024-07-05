<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $name
 * @property string $description
 * @property float $price
 * @property string $status
 * @property string $category_id
 * @property array $attachments
 */
class ProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'status' => ['required', 'string'],
            'category_id' => ['required', 'integer'],
            'attachments' => ['nullable', 'array', 'max:10'],
          //'attachments.*' => ['required', 'max:10000', 'mimes:png,jpg,jpeg'],
        ];
    }
}
