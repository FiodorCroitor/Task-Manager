<?php

namespace App\Http\Controllers\Product;

use App\Data\Product\ProductData;
use App\Exceptions\Product\ProductNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductDeleteRequest;
use App\Http\Requests\Product\ProductRequest;
use App\Models\Product;
use App\Repository\Product\ProductRepository;
use App\Services\Product\ProductManager;

class ProductController extends Controller
{
    public ProductRepository $productRepository;
    public ProductManager $productManager;

    public function __construct(ProductRepository $productRepository, ProductManager $productManager)
    {
        $this->productRepository = $productRepository;
        $this->productManager = $productManager;
    }

    public function index()
    {
        $product = $this->productRepository->getAllWithPaginatedWithFilter();
        return view('product.index', compact('product'));
    }

    public function store(ProductRequest $request, ProductData $productData)
    {
        $existedData = $this->productRepository->getById($request->id);
        try {
            $this->productManager->store($request, $productData);

            return redirect()->route('product.index');
        } catch (ProductNotFoundException $e) {
            throw  new ProductNotFoundException();
        }
    }
    //TODO Make edit function
    /*
        public function edit(Product $product)
        {
            $categories = $this->categoryRepository->getAll();

            return view('product.edit', compact(['product', 'categories']));
        }
    */
    public function show(Product $product)
    {
        return view('product.show', compact('product'));
    }

    public function update(ProductRequest $request, ProductData $productData)
    {
        $existedData = $this->productRepository->getById($request->id);
        try {
            $this->productManager->update($request, $productData);

            return redirect()->route('product.index');
        } catch (ProductNotFoundException $e) {
            throw  new ProductNotFoundException();
        }
    }

    public function destroy(ProductDeleteRequest $request)
    {

        try {
            $this->productManager->delete($request);

            return response()->json(['id' => $request->product_id]);
        } catch (ProductNotFoundException $e) {
            throw new ProductNotFoundException();
        }
    }
}
