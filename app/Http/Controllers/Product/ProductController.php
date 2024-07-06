<?php

namespace App\Http\Controllers\Product;

use App\Enums\ProductStatuses;
use App\Exceptions\Attachment\AttachmentNotFoundException;
use App\Exceptions\Attachment\AttachmentNotFoundValidationException;
use App\Exceptions\Category\CategoryNotFoundException;
use App\Exceptions\Category\CategoryNotFoundValidationException;
use App\Exceptions\Product\ProductNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Mappers\Product\ProductDataMapper;
use App\Http\Requests\Product\ProductDeleteMediaRequest;
use App\Http\Requests\Product\ProductDeleteRequest;
use App\Http\Requests\Product\ProductRequest;
use App\Models\Product;
use App\Repository\Category\CategoryRepository;
use App\Repository\Product\ProductRepository;
use App\Services\Product\ProductManager;



final class ProductController extends Controller
{

    public function __construct(
        public readonly ProductRepository  $productRepository,
        public readonly ProductManager     $productManager,
        public readonly CategoryRepository $categoryRepository,
        public readonly ProductDataMapper  $productDataMapper,
    )
    {


    }

    public function index()
    {
        $products = $this->productRepository->getAllWithPaginatedWithFilter();
        return view('v1.product.index', compact('products'));
    }

    public function create()
    {

        $statuses = ProductStatuses::getAll();
        $categories = $this->categoryRepository->getAll();
        return view('v1.product.create', compact('categories', 'statuses'));
    }

    public function store(ProductRequest $request)
    {
        $productData = $this->productDataMapper->mapFromRequestToNormalized($request);
        try {
            $this->productManager->store($productData, $request);

            return redirect()->route('products.index');
        } catch (CategoryNotFoundException $e) {
            throw new CategoryNotFoundValidationException();
        }
    }

    public function edit(Product $product)
    {
        $statuses = ProductStatuses::getAll();
        $categories = $this->categoryRepository->getAllPaginatedWithFilters();
        return view('v1.product.edit', compact('product', 'categories', 'statuses'));
    }

    public function show(Product $product)
    {
        $categories = $this->categoryRepository->getAll();
        return view('product.show', compact('product', 'categories'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $productData = $this->productDataMapper->mapFromRequestToNormalized($request);
        try {
            $this->productManager->update($productData, $product, $request);

            return redirect()->route('products.index');
        } catch (ProductNotFoundException $e) {
            throw  new ProductNotFoundException();
        }
    }

    public function delete(Product $product)
    {
        try {
            $this->productManager->delete($product);

            return redirect()->route('products.index');

        } catch (ProductNotFoundException $e) {
            throw new ProductNotFoundException();
        }


    }
    public function deleteProductMedia(ProductDeleteMediaRequest $request, Product $product)
    {
        try {
            $this->productManager->deleteMediaFromProduct($request, $product);

            return response()->json(['status' => true]);
        } catch (AttachmentNotFoundException $e) {
            throw new AttachmentNotFoundValidationException();
        }
    }
}
