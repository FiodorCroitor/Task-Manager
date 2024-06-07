<?php

namespace App\Data\Payout;
/**
 * @propetry $product_id
 * @property $user_id
 */
class PayoutData
{
    public string $product_id;
    public string $user_id;
   public function __construct(
        string $product_id,
       string $user_id,
   )
   {
       $this->user_id = $user_id;
       $this->product_id = $product_id;
   }
}
