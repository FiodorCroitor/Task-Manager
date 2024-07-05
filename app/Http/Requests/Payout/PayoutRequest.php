<?php

namespace App\Http\Requests\Payout;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int $user_id
 * @property string $price
 * @property int $product_id
 */

class PayoutRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer'],
            'price' => ['required', 'string'],
            'status' => ['required', 'string'],
            ];
    }
}
