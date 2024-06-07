<?php

namespace App\Services\Category;

use App\Data\Category\CategoryData;
use App\Exceptions\Category\CategoryNotFoundException;
use App\Http\Requests\Category\CategoryDeleteRequest;
use App\Http\Requests\Category\CategoryRequest;
use App\Models\Category;
use App\Repository\Category\CategoryRepository;

class CategoryManager
{
    public CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function store(CategoryRequest $request)
    {
        $existedCategory = $this->categoryRepository->getByName($request->name);
        if($existedCategory === null){
            throw  new CategoryNotFoundException();
        }
        Category::create([
            'name' => $request->name,
            ]);
    }

    public function update(CategoryRequest $request)
    {
        $existedCategory = $this->categoryRepository->getByName($request->name);
        if($existedCategory === null){
            throw  new CategoryNotFoundException();
        }
        Category::update([
            'name' => $request->name,
        ]);
    }
    public function delete(CategoryDeleteRequest $request): void
    {
        $categoryId = (int)$request->category_id;

        $category = $this->categoryRepository->getById($categoryId);

        if($category === null){
            throw  new CategoryNotFoundException();
        }
         $category->delete();
    }
}
