<?php

namespace App\Repository\Payout;

use App\Models\Category;
use App\Models\Payout;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\QueryBuilder;

class PayoutRepository
{
    private const COUNT_OF_PAGINATION = 12;

    public function getAllWithPaginatedWithFilter(): LengthAwarePaginator
    {
        $query = Payout::query();

        return QueryBuilder::for($query)
            ->allowedFilters([

            ])
            ->defaultSort(['-id'])
            ->allowedSorts(['id'])
            ->paginate(self::COUNT_OF_PAGINATION);
    }
    public function getByName(string $name): Payout
    {
        return Payout::where('name' . $name)->first();
    }
    public function getAll(): Collection
    {
        return Payout::all();
    }
    public function getById(int $id): ?Category
    {
        return Category::find($id);
    }
}
