<?php

namespace App\Http\Controllers\Payout;

use App\Enums\PayoutStatuses;
use App\Exceptions\Payout\PayoutNotFoundException;
use App\Exceptions\Payout\PayoutNotFoundValidationException;
use App\Exceptions\Product\ProductNotFoundException;
use App\Exceptions\Product\ProductNotFoundValiadationException;
use App\Exceptions\User\UserNotFoundException;
use App\Exceptions\User\UserNotFoundValidationException;
use App\Http\Mappers\Payout\PayoutDataMapper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Payout\PayoutDeleteRequest;
use App\Http\Requests\Payout\PayoutRequest;
use App\Models\Payout;
use App\Repository\Category\CategoryRepository;
use App\Repository\Payout\PayoutRepository;
use App\Repository\Product\ProductRepository;
use App\Repository\User\UserRepository;
use App\Services\Payout\PayoutManager;

final class PayoutController extends Controller
{

    public function __construct(
        public readonly PayoutRepository  $payoutRepository,
        public readonly PayoutDataMapper  $payoutDataMapper,
        public readonly PayoutManager     $payoutManager,
        public readonly UserRepository    $userRepository,
        public readonly ProductRepository $productRepository,

    )
    {
    }

    public function index()
    {
        $payouts = $this->payoutRepository->getAllWithPaginatedWithFilter();
        return view('v1.payout.index', compact('payouts'));
    }

    public function create()
    {
        $statuses = PayoutStatuses::getAll();
        $users = $this->userRepository->getAll();
        $products = $this->productRepository->getAll();
        return view('v1.payout.create', compact('users', 'products', 'statuses'));
    }

    public function store(PayoutRequest $request)
    {
        $payoutData = $this->payoutDataMapper->mapFromRequestToNormalized($request);
        try {
            $this->payoutManager->store($payoutData);

            return redirect()->route('payouts.index');
        } catch (UserNotFoundException $e) {
            throw new UserNotFoundValidationException();
        }
    }

    public function edit(Payout $payout)
    {
        $statuses = PayoutStatuses::getAll();
        $users = $this->userRepository->getAll();
        $products = $this->productRepository->getAll();
        return view('v1.payout.edit', compact(
            'users',
            'payout',
            'statuses',
            'products'
        ));
    }

    public function update(PayoutRequest $request, Payout $payout)
    {
        $payoutData = $this->payoutDataMapper->mapFromRequestToNormalized($request);
        try {
            $this->payoutManager->update($payoutData, $payout);

            return redirect()->route('payouts.index');
        } catch (UserNotFoundException $e) {
            throw new UserNotFoundValidationException();
        }
    }

    //Request
    public function delete(Payout $payout)
    {
        $payout->delete();

        return redirect()->route('payouts.index');
    }
}
