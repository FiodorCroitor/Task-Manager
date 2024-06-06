<?php

namespace App\Repository\Category;

use App\Models\Category;
use Illuminate\Pagination\LengthAwarePaginator;
use Ramsey\Collection\Collection;
use Spatie\QueryBuilder\QueryBuilder;

class CategoryRepository
{
    private const COUNT_OF_PAGINATION = 12;

    public function getAllWithPaginatedWithFilter(): LengthAwarePaginator
    {
        $query = Category::query();

        return QueryBuilder::for($query)
            ->allowedFilters([
                'name',
            ])
            ->defaultSort('-id')
            ->allowedSorts([
                'id',
            ])
            ->paginate(self::COUNT_OF_PAGINATION);
    }
    public function getByName(string $name): ?Category
    {
        return Category::where('name', $name)->first();
    }
    public function getAll(): \Illuminate\Support\Collection
    {
        return Category::query()->get();
    }
    public function getById(int $id): ?Category
    {
        return Category::find($id);
    }
}
