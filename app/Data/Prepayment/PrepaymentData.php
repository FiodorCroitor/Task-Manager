<?php

namespace App\Data\Prepayment;
/**
 * @property string $subjectId
 * @property string $userId
 */
class PrepaymentData
{
    public function __construct(
        public readonly ?int $subjectId,
        public readonly int $userId,

    ) {
    }
}
