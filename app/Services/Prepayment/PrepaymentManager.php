<?php

namespace App\Services\Prepayment;

use App\Data\Prepayment\PrepaymentData;
use App\Enums\PayoutStatuses;
use App\Enums\ProductStatuses;
use App\Exceptions\Payout\PayoutNotFoundException;
use App\Exceptions\Prepayment\PrepaymentNotFoundException;
use App\Exceptions\Product\ProductNotFoundException;
use App\Exceptions\User\UserNotFoundException;
use App\Http\Requests\Prepayment\PrepaymentDeleteRequest;
use App\Http\Requests\Prepayment\PrepaymentRequest;
use App\Models\Prepayment;
use App\Repository\Payout\PayoutRepository;
use App\Repository\Prepayment\PrepaymentRepository;
use App\Repository\Product\ProductRepository;
use App\Repository\User\UserRepository;

final class PrepaymentManager
{
    public function __construct(
        public readonly PrepaymentRepository $prepaymentRepository,
        public readonly PayoutRepository     $payoutRepository,
        public readonly UserRepository       $userRepository,
    )
    {

    }

    /**
     * @throws UserNotFoundException
     * @throws ProductNotFoundException
     */
    public function store(PrepaymentData $prepaymentData): void
    {

        $existedUser = $this->userRepository->getById($prepaymentData->user_id);

        if ($existedUser === null) {
            throw new UserNotFoundException();
        }

        $existedPayout = $this->payoutRepository->getById($prepaymentData->payout_id);

        if ($existedPayout === null) {
            throw new PayoutNotFoundException();
        }
/*
        if ($existedPayout->status != PayoutStatuses::FINISHED) {
            throw new PayoutNotFoundException();
        }
*/

        Prepayment::create([
            'user_id' => $prepaymentData->user_id,
            'payout_id' => $prepaymentData->payout_id,
            'amount' => $prepaymentData->amount
        ]);


        $existedUser->update([
            'prepayment_sum' => (float)$existedUser->prepayment_sum + (float)$prepaymentData->amount
        ]);

    }

    /**
     * @throws UserNotFoundException
     * @throws ProductNotFoundException
     */
    public function update(PrepaymentData $prepaymentData, Prepayment $prepayment): void
    {
        $existedUser = $this->userRepository->getById($prepaymentData->user_id);

        $prepayment->update([
            'payout_id' => $prepaymentData->payout_id,
            'user_id' => $prepaymentData->user_id,
            'amount' => $prepaymentData->amount
        ]);

        $existedUser->update([
            'prepayment_sum' => (float)$existedUser->prepayment_sum + (float)$prepaymentData->amount
        ]);
    }

    public function delete(Prepayment $prepayment): void
    {
        $prepayment->delete();
    }
}
