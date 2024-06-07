<?php

namespace App\Repository\Prepayment;

use App\Models\Category;
use App\Models\Prepayment;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\QueryBuilder;

class PrepaymentRepository
{

    private const COUNT_OF_PAGINATION = 12;

    public function getAllWithPaginatedWithFilter(): LengthAwarePaginator
    {
        $query = Prepayment::query();

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
     public function getByID(int $id): Prepayment
     {
         return Prepayment::find('id');
     }
}
