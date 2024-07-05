<?php

namespace App\Http\Requests\Prepayment;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $prepayment_id
 */
class PrepaymentDeleteRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'prepayment_id' => ['string' , 'required'],
        ];
    }
}
