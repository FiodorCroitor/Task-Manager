<?php

namespace App\Repository\Roles;

use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;

final class RolesRepository
{
  public function getAll(): Collection
  {
      return Role::query()->get();
  }
}
