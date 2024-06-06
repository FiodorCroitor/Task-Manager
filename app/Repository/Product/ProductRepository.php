<?php

namespace App\Repository\Product;

use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\QueryBuilder;

class ProductRepository
{
    private const COUNT_OF_PAGINATION = 12;
   public function getAllWithPaginatedWithFilter(): LengthAwarePaginator
   {
        $query = Product::query();

        return QueryBuilder::for($query)
            ->allowedFilters([
                'name',
                'category',
                'description',
                'price',
            ])
            ->defaultSort('-id')
            ->allowedSorts([
                'id',
            ])
            ->paginate(self::COUNT_OF_PAGINATION);
   }
 public function getById(int $id): ?Product
 {
     return Product::find($id);
 }
}
