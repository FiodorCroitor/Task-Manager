<?php

namespace App\Services\Product;

use App\Data\Product\ProductData;
use App\Enums\ProductStatuses;
use App\Exceptions\Attachment\AttachmentNotFoundException;
use App\Exceptions\Category\CategoryNotFoundException;
use App\Exceptions\Product\ProductNotFoundException;
use App\Http\Requests\Product\ProductDeleteMediaRequest;
use App\Http\Requests\Product\ProductRequest;
use App\Models\Product;
use App\Repository\Attachments\AttachmentsRepository;
use App\Repository\Category\CategoryRepository;
use App\Repository\Product\ProductRepository;
use App\Services\Attachments\AttachmentsManager;

final class ProductManager
{


    public function __construct(
        public readonly ProductRepository     $productRepository,
        public readonly CategoryRepository    $categoryRepository,
        public readonly AttachmentsRepository $attachmentsRepository,
        public readonly AttachmentsManager    $attachmentsManager,
    )
    {}

    /**
     * @throws CategoryNotFoundException
     */
    public function store(ProductData $productData, ProductRequest $request): void
    {
        $existedCategory = $this->categoryRepository->getById($productData->category_id);
        if ($existedCategory === null) {
            throw new CategoryNotFoundException();
        }

        $product = Product::create([
            'name' => $productData->name,
            'category_id' => $existedCategory->id,
            'description' => $productData->description,
            'status' => $productData->status,
        ]);

        $product->save();

        $this->attachmentsManager->storeToMediaAttachmentsFromRequestToModel($request, $product);
    }

    /**
     * @throws ProductNotFoundException
     */
    public function update(ProductData $productData, Product $product, ProductRequest $request): void
    {
        $existedCategory = $this->categoryRepository->getById($productData->category_id);

        if ($existedCategory === null) {
            throw new ProductNotFoundException();
        }

        $product->update([
            'name' => $productData->name,
            'category_id' => $existedCategory->id,
            'description' => $productData->description,
            'status' => $productData->status,
        ]);

        $product->save();

        $this->attachmentsManager->storeToMediaAttachmentsFromRequestToModel($request, $product);
    }

    public function delete(Product $product): void
    {
        $product->delete();
    }

    /**
     * @throws AttachmentNotFoundException
     */
    public function deleteMediaFromProduct(ProductDeleteMediaRequest $request, Product $product): void
    {
        $existedAttachment = $this->attachmentsRepository->getById($product, (int)$request->id);

        if ($existedAttachment === null) {
            throw new AttachmentNotFoundException();
        }

        $this->attachmentsManager->deleteAttachmentsFromModel($product, (int)$request->id);
    }
}
