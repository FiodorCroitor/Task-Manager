<?php

namespace App\Http\Requests\Payout;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int $payout_id
 */

class PayoutDeleteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'payout_id' => ['integer' , 'required']
        ];
    }
}
