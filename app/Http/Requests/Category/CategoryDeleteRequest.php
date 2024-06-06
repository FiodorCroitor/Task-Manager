<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryDeleteRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'category_id' => ['required', 'integer'],
        ];
    }
}
