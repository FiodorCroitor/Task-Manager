<?php

namespace App\Http\Controllers\Payout;

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
use App\Repository\Payout\PayoutRepository;
use App\Repository\Product\ProductRepository;
use App\Repository\User\UserRepository;
use App\Services\Payout\PayoutManager;

class PayoutController extends Controller
{
    public PayoutRepository $payoutRepository;
    public PayoutDataMapper $payoutDataMapper;
    public PayoutManager $payoutManager;
    public ProductRepository $productRepository;
    public UserRepository $userRepository;

    public function __construct(
        PayoutRepository  $payoutRepository,
        PayoutDataMapper  $payoutDataMapper,
        PayoutManager     $payoutManager,
        ProductRepository $productRepository,
        UserRepository    $userRepository,
    )
    {
        $this->payoutRepository = $payoutRepository;
        $this->payoutDataMapper = $payoutDataMapper;
        $this->payoutManager = $payoutManager;
        $this->productRepository = $productRepository;
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $payout = $this->payoutRepository->getAllWithPaginatedWithFilter();
        return view('payout.index', compact('payout'));
    }

    public function store(PayoutRequest $request)
    {
        $payoutData = $this->payoutDataMapper->mapFromRequestToNormalized($request);
        try {
            $this->payoutManager->store($request, $payoutData);

            return redirect()->route('payout.index');
        } catch (ProductNotFoundException $e) {
            throw  new ProductNotFoundValiadationException();
        } catch (UserNotFoundException $e) {
            throw new UserNotFoundValidationException();
        }
    }

    public function edit(Payout $payout , PayoutRequest $request)
    {
        $user = $this->userRepository->getById($request->user_id);
        $product = $this->productRepository->getALL();
        return view('payout.index' , compact('user' , 'product'));
    }
    public function update(PayoutRequest $request)
    {
        $payoutData = $this->payoutDataMapper->mapFromRequestToNormalized($request);
        try {
            $this->payoutManager->store($request, $payoutData);

            return redirect()->route('payout.index');
        } catch (ProductNotFoundException $e) {
            throw  new ProductNotFoundValiadationException();
        } catch (UserNotFoundException $e) {
            throw new UserNotFoundValidationException();
        }
    }
    public function delete(PayoutDeleteRequest $request)
    {
        try {
            $this->payoutManager->delete($request);

            return response()->json(['id' => $request->payout_id]);
        } catch (PayoutNotFoundException $e) {
            throw new PayoutNotFoundValidationException();
        }
    }

}
