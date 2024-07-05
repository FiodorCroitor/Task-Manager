<?php

namespace App\Http\Requests\Prepayment;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $payout_id
 * @property string $user_id
 * @property string $amount
 */
class PrepaymentRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'user_id' => ['required' , 'string'],
            'payout_id' => ['required' , 'string'],
            'amount' => ['required', 'string'],
        ];
    }
}
