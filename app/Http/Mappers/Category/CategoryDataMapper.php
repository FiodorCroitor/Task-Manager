<?php

namespace App\Http\Mappers\Category;

use App\Data\Category\CategoryData;
use App\Http\Requests\Category\CategoryRequest;
use PhpParser\Lexer\TokenEmulator\ReadonlyTokenEmulator;

class CategoryDataMapper
{

    public function mapFromRequestToNormalized(CategoryRequest $request): CategoryData
    {
        return new CategoryData(
            $request->name,
            $request->status,
        );
    }
}
