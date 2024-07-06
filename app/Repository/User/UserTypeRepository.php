<?php

namespace App\Repository\User;

use App\Models\UserType;
use Illuminate\Support\Collection;

final class UserTypeRepository
{
    public function getAll(): ?Collection
    {
        return UserType::all();
    }

    public function getByName(string $name): ?UserType
    {
        return UserType::where('name', $name)->first();
    }
}
