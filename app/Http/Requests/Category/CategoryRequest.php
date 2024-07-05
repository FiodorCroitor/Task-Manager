<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
/**
 * @property string $name
 * @property string $status
 * @property string $id
 */

class CategoryRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'status' => ['required', 'string'],
        ];
    }

}
