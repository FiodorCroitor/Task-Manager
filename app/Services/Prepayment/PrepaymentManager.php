<?php

namespace App\Services\Prepayment;

use App\Exceptions\Prepayment\PrepaymentNotFoundException;
use App\Http\Requests\Prepayment\PrepaymentRequest;
use App\Repository\Prepayment\PrepaymentRepository;

class PrepaymentManager
{
   public PrepaymentRepository $prepaymentRepository;
    public function __construct(
        PrepaymentRepository $prepaymentRepository
    )
    {
        $this->prepaymentRepository  = $prepaymentRepository;
    }
    public function store(PrepaymentRequest $request)
    {

    }
}
