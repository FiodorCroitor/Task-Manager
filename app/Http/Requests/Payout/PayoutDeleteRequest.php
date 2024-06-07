<?php

namespace App\Http\Requests\Payout;

use Illuminate\Foundation\Http\FormRequest;

class PayoutDeleteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'payout_id' => ['required','string' ]
        ];
    }
}
