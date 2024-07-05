<?php

namespace App\Data\Prepayment;
/**
 * @property int $user_id
 * @property string $payout_id
 * @property string $amount
 */
class PrepaymentData
{

    public function __construct(
        public readonly int    $user_id,
        public readonly string $payout_id,
        public readonly string $amount,
    )
    {
    }

}
