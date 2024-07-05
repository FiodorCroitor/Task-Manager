<?php

namespace App\Http\Controllers\User;

use App\Data\User\UserData;
use App\Exceptions\NotAjaxRequestException;
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
use Illuminate\Support\Facades\Request;

final class UserController extends Controller
{
    public function __construct(
        public readonly UserRepository $userRepository,
        public readonly UserManager    $userManager,
        public readonly UserDataMapper $userDataMapper
    )
    {
    }

    public function index()
    {
        $users = $this->userRepository->getAllPaginatedWithFilters();
        return view('v1.user.index', compact('users'));
    }

    public function create()
    {
        return view('v1.user.create');
    }

    public function store(UserRequest $request)
    {
        $userData = $this->userDataMapper->mapFromRequestToNormalized($request);
        try {
            $this->userManager->store($userData);

            return redirect()->route('users.index');
        } catch (UserDuplicatedMailException $e) {
            throw new UserDuplicatedMailValidationException();
        }
    }


    public function edit(User $user)
    {
        return view('v1.user.edit', compact('user'));
    }

    public function update(User $user, UserRequest $request)
    {
        $userData = $this->userDataMapper->mapFromRequestToNormalized($request);
        try {
            $this->userManager->update($user, $userData);

            return redirect()->route('users.index');
        } catch (UserNotFoundException $e) {
            throw new UserNotFoundValidationException();
        } catch (UserDuplicatedMailException $e) {
            throw new UserDuplicatedMailValidationException();
        }
    }

    public function delete(User $user)
    {
        try {
            $this->userManager->delete($user);

            return redirect()->route('users.index');
        }catch (UserNotFoundException $e) {
            throw new UserNotFoundValidationException();
        }
    }
}
