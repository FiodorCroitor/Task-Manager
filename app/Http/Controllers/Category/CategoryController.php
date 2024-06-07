<?php

namespace App\Http\Controllers\Category;

use App\Data\Category\CategoryData;
use App\Exceptions\Category\CategoryNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Mappers\Category\CategoryDataMapper;
use App\Http\Requests\Category\CategoryDeleteRequest;
use App\Http\Requests\Category\CategoryRequest;
use App\Models\Category;
use App\Repository\Category\CategoryRepository;
use App\Services\Category\CategoryManager;

class CategoryController extends Controller
{
    public CategoryRepository $categoryRepository;
    public CategoryData $categoryData;
    public CategoryDataMapper $categoryDataMapper;
    public CategoryManager $categoryManager;

    public function __construct(
        CategoryRepository $categoryRepository,
        CategoryData       $categoryData,
        CategoryDataMapper $categoryDataMapper,
        CategoryManager    $categoryManager)
    {
        $this->categoryRepository = $categoryRepository;
        $this->categoryData = $categoryData;
        $this->categoryDataMapper = $categoryDataMapper;
        $this->categoryManager = $categoryManager;
    }

    public function index()
    {
        $categories = $this->categoryRepository->getAll();
        return view('category.index', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {

        $categoryData = $this->categoryDataMapper->mapFromRequestToNormalized($request);
        try {
            $this->categoryManager->store($request);
        } catch (CategoryNotFoundException $e) {
            throw new CategoryNotFoundException();
        }
    }

    public function edit(Category $category)
    {
        return view('category.show', compact('category'));
    }

    public function update(CategoryRequest $request)
    {
        $category = $this->categoryRepository->getById($request->category_id);
        if ($category === null) {
            throw new CategoryNotFoundException();
        }
        Category::update([
            'name',
        ]);
    }
    public function delete(CategoryDeleteRequest $request , Category $category)
    {
        try {
            $this->categoryManager->delete($request);

            return response()->json(['id' => $request->category_id]);
        } catch (CategoryNotFoundException $e) {
            throw new CategoryNotFoundException();
        }
    }
}
