<?php

namespace App\Http\Mappers\Prepayment;

use App\Data\Prepayment\PrepaymentData;
use App\Http\Requests\Prepayment\PrepaymentRequest;

class PrepaymentDataMapper
{
    public function mapFromRequestToNormalized(PrepaymentRequest $request): PrepaymentData
    {
        return new PrepaymentData(
            $request->user_id,
            $request->payout_id,
            $request->amount,
        );
    }
}
