<?php

namespace App\Services\Payout;

use App\Data\Payout\PayoutData;
use App\Enums\PayoutStatuses;
use App\Enums\ProductStatuses;
use App\Exceptions\Payout\PayoutNotFoundException;
use App\Exceptions\Product\ProductNotFoundException;
use App\Exceptions\User\UserNotFoundException;
use App\Http\Requests\Payout\PayoutDeleteRequest;
use App\Models\Payout;
use App\Repository\Payout\PayoutRepository;
use App\Repository\Product\ProductRepository;
use App\Repository\User\UserRepository;


final class PayoutManager
{

    public function __construct(
        public PayoutRepository  $payoutRepository,
        public UserRepository    $userRepository,
        public ProductRepository $productRepository,
    )
    {
    }

    /**
     * @throws UserNotFoundException
     */
    public function store(PayoutData $payoutData): void
    {

        $existedUser = $this->userRepository->getById($payoutData->user_id);
        $existedProduct = $this->productRepository->getById($payoutData->product_id);

        if ($existedUser === null) {
            throw new UserNotFoundException();
        }

        if ($existedProduct === null || $existedProduct->status != ProductStatuses::FINISHED) {
            throw new ProductNotFoundException();
        }

        Payout::create([
            'user_id' => $payoutData->user_id,
            'product_id' => $payoutData->product_id,
            'price' => $payoutData->price,
            'status' => $payoutData->status,
        ]);

    }

    /**
     * @throws UserNotFoundException
     */
    public function update(PayoutData $payoutData, Payout $payout): void
    {
        $existedUser = $this->userRepository->getById($payoutData->user_id);

        if ($existedUser === null) {
            throw new UserNotFoundException();
        }

        $payout->update([
            'user_id' => $existedUser,
            'product_id' => $payoutData->product_id,
            'price' => $payoutData->price,
            'status' => $payoutData->status,
        ]);
    }

    /**
     * @throws PayoutNotFoundException
     */
    public function delete(PayoutDeleteRequest $request): void
    {
        $payoutId = (int)$request->payout_id;
        $payout = $this->payoutRepository->getById($payoutId);

        if ($payout === null) {
            throw  new PayoutNotFoundException();
        }
        $payout->delete();
    }
}
