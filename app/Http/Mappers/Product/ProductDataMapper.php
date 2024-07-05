<?php

namespace App\Http\Mappers\Product;

use App\Data\Product\ProductData;
use App\Http\Requests\Product\ProductRequest;

class ProductDataMapper
{
    public function mapFromRequestToNormalized(ProductRequest $request): ProductData
    {
        return new ProductData(
            $request->name,
            $request->description,
            $request->status,
            $request->category_id,
            $request->attachments,
        );
    }
}
