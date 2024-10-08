<?php

namespace App\Repository\User;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\QueryBuilder;
use function Symfony\Component\String\s;

class UserRepository
{
    private const COUNT_OF_PAGINATION = 12;

    public function getAllPaginatedWithFilters(): LengthAwarePaginator
    {
        $query = User::query();

        return QueryBuilder::for($query)
            ->allowedFilters([

            ])
            ->defaultSort('-id')
            ->allowedSorts([
                'id',
            ])
            ->paginate(self::COUNT_OF_PAGINATION);
    }
   public function getFirstByEmailWhereNotUserId(string $email, int $user_id): ?User
   {
       return User::query()
           ->where('email', $email)
           ->whereNot('id', $user_id)
           ->first();
   }
   public function getFirstByEmail(string $email): ?User
   {
       return User::where('email', $email)->first();
   }
   public function getFirstByEmailWithTrashed(string $email): ?User
   {
        return User::query()->where('email', $email)->withTrashed()->first();
   }

    public function getById(int $id): ?User
    {
        return User::find($id);
    }
    public function getFirstByUserName(string $name): ?User
    {
        return User::where('name', $name)->first();
    }
    public function getLast(): ?User
    {
        return User::query()->get()->last();
    }
    public function getAll()
    {
        return User::query()->get();
    }
    public function getByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }
}
