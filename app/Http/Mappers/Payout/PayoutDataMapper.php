<?php

namespace App\Http\Mappers\Payout;

use App\Data\Payout\PayoutData;
use App\Http\Requests\Payout\PayoutRequest;

class PayoutDataMapper
{
    public function mapFromRequestToNormalized(PayoutRequest $request): PayoutData
    {
        return new PayoutData(
            $request->user_id,
            $request->product_id,
            $request->price,
            $request->status,
        );
    }
}
