<?php

namespace App\Http\Controllers\Prepayment;


use App\Exceptions\Prepayment\PrepaymentNotFoundException;
use App\Exceptions\Prepayment\PrepaymentNotFoundValidationException;
use App\Http\Controllers\Controller;
use App\Http\Mappers\Prepayment\PrepaymentDataMapper;
use App\Http\Requests\Prepayment\PrepaymentRequest;
use App\Models\Prepayment;
use App\Repository\Payout\PayoutRepository;

// Добавлен импорт PayoutRepository
use App\Repository\Prepayment\PrepaymentRepository;
use App\Repository\User\UserRepository;
use App\Services\Prepayment\PrepaymentManager;

class PrepaymentController extends Controller
{
    public function __construct(
        public readonly PrepaymentRepository $prepaymentRepository,
        public readonly UserRepository       $userRepository,
        public readonly PayoutRepository     $payoutRepository, // Добавлена зависимость PayoutRepository
        public readonly PrepaymentDataMapper $prepaymentDataMapper,
        public readonly PrepaymentManager    $prepaymentManager,
    )
    {

    }

    public function index()
    {
        $prepayments = $this->prepaymentRepository->getAllWithPaginatedWithFilter();
        return view('v1.prepayment.index', compact('prepayments'));
    }

    public function create()
    {
        $users = $this->userRepository->getAll();
        $payouts = $this->payoutRepository->getAll();
        return view('v1.prepayment.create', compact('users', 'payouts'));
    }

    public function store(PrepaymentRequest $request)
    {
        $prepaymentData = $this->prepaymentDataMapper->mapFromRequestToNormalized($request);

        try {
            $this->prepaymentManager->store($prepaymentData);

            return redirect()->route('prepayments.index');
        } catch (PrepaymentNotFoundException $e) {
            throw new PrepaymentNotFoundValidationException();
        }
    }

    public function edit(Prepayment $prepayment)
    {
        $users = $this->userRepository->getAll();
        $payouts = $this->payoutRepository->getAll();
        return view('v1.prepayment.edit', compact(
            'prepayment',
            'users',
            'payouts'));
    }

    public function update(PrepaymentRequest $request, Prepayment $prepayment)
    {
        $prepaymentData = $this->prepaymentDataMapper->mapFromRequestToNormalized($request);

        try {
            $this->prepaymentManager->update($prepaymentData, $prepayment);

            return redirect()->route('prepayments.index');
        } catch (PrepaymentNotFoundException $e) {
            throw new PrepaymentNotFoundValidationException();
        }
    }

    public function delete(Prepayment $prepayment)
    {
        try {
            $this->prepaymentManager->delete($prepayment);

            return redirect()->route('prepayments.index');
        } catch (PrepaymentNotFoundException $e) {
            throw new PrepaymentNotFoundValidationException('');
        }
    }
}
