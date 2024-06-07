<?php

namespace App\Services\Prepayment;

use App\Data\Prepayment\PrepaymentData;
use App\Exceptions\Prepayment\PrepaymentNotFoundException;
use App\Exceptions\Product\ProductNotFoundException;
use App\Exceptions\User\UserNotFoundException;
use App\Http\Requests\Prepayment\PrepaymentDeleteRequest;
use App\Http\Requests\Prepayment\PrepaymentRequest;
use App\Models\Prepayment;
use App\Models\User;
use App\Repository\Prepayment\PrepaymentRepository;
use App\Repository\Product\ProductRepository;
use App\Repository\User\UserRepository;

class PrepaymentManager
{
    public function __construct(
        public readonly PrepaymentRepository $prepaymentRepository,
        public readonly ProductRepository    $productRepository,
        public readonly UserRepository       $userRepository,
    )
    {

    }

    public function store(PrepaymentData $prepaymentData): void
    {
        if ($prepaymentData->userId !== null) {
            $existedProduct = $this->productRepository->getById($prepaymentData->productId);
            if ($existedProduct === null) {
                throw  new ProductNotFoundException();
            }
            $productId = $prepaymentData->productId;
        }
        $existedUser = $this->userRepository->getById($prepaymentData->userId);

        if ($existedUser === null) {
            throw  new UserNotFoundException();
        }

        Prepayment::create([
            'userId' => $prepaymentData->userId,
            'productId' => $prepaymentData->productId,
        ]);
    }

    public function update(PrepaymentData $prepaymentData): void
    {
        if ($prepaymentData->userId !== null) {
            $existedProduct = $this->productRepository->getById($prepaymentData->productId);
            if ($existedProduct === null) {
                throw  new ProductNotFoundException();
            }
            $productId = $prepaymentData->productId;
        }
        $existedUser = $this->userRepository->getById($prepaymentData->userId);

        if ($existedUser === null) {
            throw  new UserNotFoundException();
        }

        Prepayment::update([
            'userId' => $prepaymentData->userId,
            'productId' => $prepaymentData->productId,
        ]);
    }

    public function delete(PrepaymentDeleteRequest $request)
    {
        $prepaymentId = (int)$request->prepayment_id;

        $prepayment = $this->prepaymentRepository->getById($prepaymentId);

        if ($prepayment === null) {
            throw new PrepaymentNotFoundException();
        }

        $prepayment->delete();
    }


}
