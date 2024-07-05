<?php

namespace App\Http\Controllers\Category;

use App\Exceptions\Category\CategoryNotFoundException;
use App\Exceptions\Category\CategoryNotFoundValidationException;
use App\Exceptions\Category\CategoryAlreadyExistsException;
use App\Http\Controllers\Controller;
use App\Http\Mappers\Category\CategoryDataMapper;
use App\Http\Requests\Category\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Request;
use App\Repository\Category\CategoryRepository;
use App\Services\Category\CategoryManager;

final class CategoryController extends Controller
{
    public function __construct(
        public readonly CategoryRepository $categoryRepository,
        public readonly CategoryDataMapper $categoryDataMapper,
        public readonly CategoryManager    $categoryManager,
    )
    {
    }

    public function index()
    {
        $categories = $this->categoryRepository->getAllPaginatedWithFilters();
        return view('v1.category.index', compact('categories'));
    }

    public function create()
    {
        return view('v1.category.create');
    }

    public function store(CategoryRequest $request)
    {
        $categoryData = $this->categoryDataMapper->mapFromRequestToNormalized($request);
        try {
            $this->categoryManager->store($categoryData);

            return redirect()->route('categories.index');
        } catch (CategoryAlreadyExistsException $e) {
            throw new CategoryNotFoundValidationException();
        }
    }

    public function edit(Category $category)
    {
        return view('v1.category.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $categoryData = $this->categoryDataMapper->mapFromRequestToNormalized($request);

        try {
            $this->categoryManager->update($categoryData, $category);

            return redirect()->route('categories.index');
        } catch (CategoryAlreadyExistsException $e) {
            throw new CategoryNotFoundValidationException();
        }
    }

    public function delete(Request $request, Category $category)
    {
        try {
            $this->categoryManager->delete($category);

            return redirect()->route('categories.index');
        } catch (CategoryNotFoundException $e) {
           throw new CategoryNotFoundValidationException();
        }
    }
}
