<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int $category_id
 */

class CategoryDeleteRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'category_id' => ['required', 'integer'],
        ];
    }
}
