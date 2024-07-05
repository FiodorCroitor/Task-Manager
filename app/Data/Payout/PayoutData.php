<?php

namespace App\Data\Payout;
/**
 * @property $user_id
 * @property $price
 * @property $status
 * @property $product_id
 */
class PayoutData
{


    public function __construct(
        public readonly string $user_id,
        public readonly string $product_id,
        public readonly string $price,
        public readonly string $status,
    )
    {}
}
