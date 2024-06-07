<?php

namespace App\Http\Controllers\Prepayment;

use App\Exceptions\NotAjaxRequestException;
use App\Exceptions\Prepayment\PrepaymentNotFoundException;
use App\Exceptions\Prepayment\PrepaymentNotFoundValidationException;
use App\Exceptions\Product\ProductNotFoundException;
use App\Exceptions\Product\ProductNotFoundValiadationException;
use App\Exceptions\Subject\SubjectNotFoundException;
use App\Exceptions\Subject\SubjectNotFoundValidationException;
use App\Exceptions\User\UserNotFoundException;
use App\Exceptions\User\UserNotFoundValidationException;
use App\Http\Controllers\Controller;
use App\Http\Mappers\Prepayment\PrepaymentDataMapper;
use App\Http\Requests\Prepayment\PrepaymentDeleteRequest;
use App\Http\Requests\Prepayment\PrepaymentRequest;
use App\Models\Prepayment;
use App\Repository\Payout\PayoutRepository;
use App\Repository\Prepayment\PrepaymentRepository;
use App\Repository\Product\ProductRepository;
use App\Repository\User\UserRepository;
use App\Services\Prepayment\PrepaymentManager;

class PrepaymentController extends Controller
{
    public function __construct(
        public readonly PrepaymentRepository $prepaymentRepository,
        public readonly UserRepository       $userRepository,
        public readonly ProductRepository    $productRepository,
        public readonly PrepaymentManager    $prepaymentManager,
        public readonly PrepaymentDataMapper $prepaymentDataMapper,
    )
    {

    }

    public function index()
    {
        $prepayments = $this->prepaymentRepository->getAllWithPaginatedWithFilter();
        $users = $this->userRepository->getAll();
        $products = $this->productRepository->getAll();
        return view('prepayment.index', compact('prepayments', 'users', 'products'));
    }

    public function store(PrepaymentRequest $request)
    {
        $prepaymentData = $this->prepaymentDataMapper->mapFromRequestToNormalized($request);


        try {
            $this->prepaymentManager->store($prepaymentData);

            return redirect()->route('prepayment.index');
        } catch (ProductNotFoundException $e) {
            throw new ProductNotFoundValiadationException();
        } catch (UserNotFoundException $e) {
            throw new UserNotFoundValidationException();
        }

    }
    public function edit(Prepayment $prepayment)
    {

        $users = $this->userRepository->getAll();
        $subjects = $this->productRepository->getAll();

        return view('prepayment.edit', compact([
            'prepayment',
            'users',
            'subjects'
        ]));
    }
    public function update(PrepaymentRequest $request, Prepayment $prepayment)
    {
        $prepaymentData = $this->prepaymentDataMapper->mapFromRequestToNormalized($request);

        try {
            $this->prepaymentManager->update($prepaymentData, $prepayment);

            return redirect()->route('prepayment.index');
        } catch (ProductNotFoundValiadationException $e) {
            throw new ProductNotFoundValiadationException();
        } catch (UserNotFoundException $e) {
            throw new UserNotFoundValidationException();
        }
    }
    public function destroy(PrepaymentDeleteRequest $request)
    {

        try {
            $this->prepaymentManager->delete($request);

            return response()->json(['id' => $request->prepayment_id]);
        } catch (PrepaymentNotFoundException $e) {
            throw new PrepaymentNotFoundValidationException();
        }
    }
}
