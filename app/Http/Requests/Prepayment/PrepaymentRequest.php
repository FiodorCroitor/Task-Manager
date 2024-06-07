<?php

namespace App\Http\Requests\Prepayment;

use Illuminate\Foundation\Http\FormRequest;

class PrepaymentRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'subjectId' => ['required' , 'string'],
            'userId' => ['required' , 'string'],
        ];
    }
}
