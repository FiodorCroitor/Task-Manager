<?php

namespace App\Services\Product;

use App\Data\Product\ProductData;
use App\Exceptions\Product\ProductNotFoundException;
use App\Http\Requests\Product\ProductDeleteRequest;
use App\Http\Requests\Product\ProductRequest;
use App\Models\Product;
use App\Repository\Product\ProductRepository;

class ProductManager
{
    public ProductRepository $productRepository;
    public ProductData $productData;
    public function __construct(ProductRepository $productRepository , ProductData $productData)
    {
        $this->productRepository = $productRepository;
        $this->productData = $productData;
    }

    public function store(ProductRequest $request , ProductData $productData): void
    {
        //TODO: Implement store() method.
         $existedProduct = $this->categoryRepository->getById($productData->category_id);


        if ($existedProduct === null) {
            throw new ProductNotFoundException();
        }
         $product = Product::create([
             'name' => $productData->name,
             'category_id' => $productData->category_id,
             'description' => $productData->description,
             'price' => $productData->price,
             'status' => $productData->status,

         ]);
    }
    public function show(Product $product)
    {
        return  view('product.show', compact('product'));
    }
    public function update(ProductRequest $request , ProductData $productData): void
    {
        //TODO: Implement store() method.
        $existedProduct = $this->categoryRepository->getById($productData->category_id);


        if ($existedProduct === null) {
            throw new ProductNotFoundException();
        }
        $product = Product::update([
            'name' => $productData->name,
            'category_id' => $productData->category_id,
            'description' => $productData->description,
            'price' => $productData->price,
            'status' => $productData->status,
        ]);
    }

    public function delete(ProductDeleteRequest $request): void
    {
        $product_id =(int)$request->priduct_id;
        $product =$this->productRepository->getById($product_id);


        if ($product === null) {
            throw new ProductNotFoundException();
        }
        $product->delete();
    }
    //TODO: Implement delete() method.
    public function deleteMediaFromProduct(ProductMediaDeleteRequest $request, Product $product): void
    {
        $existedAttachment = $this->attachmentsRepository->getById($product, (int)$request->id);

        if ($existedAttachment === null)
        {
            throw new AttachmentNotFoundException();
        }

        $this->attachmentsManager->deleteAttachmentsFromModel($product, (int)$request->id);
    }
}
