<?php

namespace App\Services\Product;

use App\Data\Product\ProductData;
use App\Exceptions\Attachment\AttachmentNotFoundException;
use App\Exceptions\Product\ProductNotFoundException;
use App\Http\Requests\Product\ProductDeleteRequest;
use App\Http\Requests\Product\ProductRequest;
use App\Models\Product;
use App\Repository\Attachments\AttachmentsRepository;
use App\Repository\Category\CategoryRepository;
use App\Repository\Product\ProductRepository;
use App\Services\Attachments\AttachmentsManager;

class ProductManager
{
    public ProductRepository $productRepository;
    public ProductData $productData;
    public CategoryRepository $categoryRepository;
    public AttachmentsRepository $attachmentsRepository;
    public AttachmentsManager $attachmentsManager;
    public function __construct(
        ProductRepository $productRepository ,
        ProductData $productData ,
        CategoryRepository $categoryRepository,
        AttachmentsRepository $attachmentsRepository,
        AttachmentsManager $attachmentsManager
    )
    {
        $this->productRepository = $productRepository;
        $this->productData = $productData;
        $this->categoryRepository = $categoryRepository;
        $this->attachmentsRepository = $attachmentsRepository;
        $this->attachmentsManager = $attachmentsManager;
    }

    public function store(ProductRequest $request , ProductData $productData): void
    {
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
        $productId =(int)$request->product_id;
        $product =$this->productRepository->getById($productId);


        if ($product === null) {
            throw new ProductNotFoundException();
        }
        $product->delete();
    }
    public function deleteMediaFromProduct(ProductDeleteRequest $request, Product $product): void
    {
        $existedAttachment = $this->attachmentsRepository->getById($product, (int)$request->id);

        if ($existedAttachment === null)
        {
            throw new AttachmentNotFoundException();
        }

        $this->attachmentsManager->deleteAttachmentsFromModel($product, (int)$request->id);
    }
}
