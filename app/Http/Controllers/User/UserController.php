<?php

namespace App\Http\Controllers\User;

use App\Data\User\UserData;
use App\Exceptions\User\UserDuplicatedMailException;
use App\Exceptions\User\UserDuplicatedMailValidationException;
use App\Exceptions\User\UserNotFoundException;
use App\Exceptions\User\UserNotFoundValidationException;
use App\Http\Controllers\Controller;
use App\Http\Mappers\User\UserDataMapper;
use App\Http\Requests\User\UserDeleteRequest;
use App\Http\Requests\User\UserRequest;
use App\Models\User;
use App\Repository\User\UserRepository;
use App\Services\User\UserManager;

final class UserController extends Controller
{
    public UserRepository $userRepository;
    public UserManager $userManager;
    public UserDataMapper $userDataMapper;

    public function __construct(
        UserRepository $userRepository,
        UserManager    $userManager,
        UserDataMapper $userDataMapper
    )
    {
        $this->userRepository = $userRepository;
        $this->userManager = $userManager;
        $this->userDataMapper = $userDataMapper;
    }

    public function index()
    {
        $user = $this->userRepository->getAllPaginatedWithFilters();

        return view('user.index', compact('user'));
    }

    public function store(UserRequest $request, UserData $userData)
    {
        $existedUser = $this->userRepository->getFirstByEmail($request->email);
        try {
            $this->userManager->store($request, $userData);

            return redirect()->route('user.index');
        } catch (UserDuplicatedMailException $e) {
            throw new UserDuplicatedMailValidationException();
        }
    }

    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('user.edit');
    }

    public function update(User $user, UserRequest $request)
    {
        $userData = $this->userDataMapper->mapFromRequestToNormalized($request);
        try {
            $this->userManager->store($request, $userData);

            return redirect()->route('user.index');
        } catch (UserNotFoundException $e) {
            throw  new UserNotFoundValidationException();
        } catch (UserDuplicatedMailException $e) {
            throw  new UserDuplicatedMailValidationException();
        }
    }

    public function delete(UserDeleteRequest $request)
    {
        try {
            $this->userManager->delete($request);

            return response()->json(['id' => $request->user_id]);

        } catch (UserNotFoundException $e) {
            throw new UserNotFoundValidationException();
        }
    }


}
