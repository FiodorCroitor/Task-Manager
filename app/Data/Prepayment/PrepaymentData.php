<?php

namespace App\Data\Prepayment;
/** @property string productId;
 * @property string $userId;
 */
class PrepaymentData
{
    public function __construct(
        public readonly ?int $productId,
        public readonly int $userId,
    ) {
    }
}
