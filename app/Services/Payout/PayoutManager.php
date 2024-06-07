<?php

namespace App\Services\Payout;

use App\Data\Payout\PayoutData;
use App\Exceptions\Payout\PayoutNotFoundException;
use App\Exceptions\Product\ProductNotFoundException;
use App\Exceptions\User\UserNotFoundException;
use App\Http\Requests\Payout\PayoutDeleteRequest;
use App\Http\Requests\Payout\PayoutRequest;
use App\Models\Payout;
use App\Repository\Payout\PayoutRepository;
use App\Repository\Product\ProductRepository;
use App\Repository\User\UserRepository;
use PHPUnit\Event\Runtime\PHP;

class PayoutManager
{

    public function __construct(
        public readonly PayoutRepository  $payoutRepository,
        public readonly UserRepository    $userRepository,
        public readonly ProductRepository $productRepository,
    )
    {
    }

    public function store(PayoutRequest $request, PayoutData $payoutData)
    {
        $existedUser = $this->userRepository->getFirstByUserName($request->name);
        if ($existedUser === null) {
            throw  new UserNotFoundException();
        }

        $existedProduct = $this->productRepository->getById($request->product_id);
        if ($existedProduct === null) {
            throw  new ProductNotFoundException();
        }
        Payout::create([
            'user_id' => $payoutData->user_id,
            'product_id' => $payoutData->product_id,
        ]);
    }

    public function update(PayoutRequest $request, PayoutData $payoutData)
    {
        $existedUser = $this->userRepository->getFirstByUserName($request->name);
        if ($existedUser === null) {
            throw  new UserNotFoundException();
        }

        $existedProduct = $this->productRepository->getById($request->product_id);
        if ($existedProduct === null) {
            throw  new ProductNotFoundException();
        }
        Payout::update([
            'user_id' => $payoutData->user_id,
            'product_id' => $payoutData->product_id,
        ]);
    }

    public function delete(PayoutDeleteRequest $request)
    {
        $payoutId = (int)$request->payout_id;
        $payout = $this->payoutRepository->getById($payoutId);

        if($payout === null)
        {
            throw  new PayoutNotFoundException();
        }
        $payout->delete();
    }
}
