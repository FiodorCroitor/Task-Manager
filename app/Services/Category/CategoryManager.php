<?php

namespace App\Services\Category;

use App\Data\Category\CategoryData;
use App\Exceptions\Category\CategoryNotFoundException;
use App\Exceptions\Category\CategoryAlreadyExistsException;
use App\Models\Category;
use App\Repository\Category\CategoryRepository;

final class CategoryManager
{
    public function __construct(public readonly CategoryRepository $categoryRepository)
    {
    }

    /**
     * @throws CategoryAlreadyExistsException
     */
    public function store(CategoryData $categoryData): void
    {
        $existedCategory = $this->categoryRepository->getByName($categoryData->name);
        if ($existedCategory !== null) {
            throw new CategoryNotFoundException("Category with name '{$categoryData->name}' already exists.");
        }

        Category::create([
            'name' => $categoryData->name,
            'status' => $categoryData->status,
        ]);
    }

    /**
     * @throws CategoryNotFoundException
     */
    public function update(CategoryData $categoryData, Category $category): void
    {
        if ($category->name !== $categoryData->name) {
            $existedCategory = $this->categoryRepository->getByName($categoryData->name);
            if ($existedCategory !== null) {
                throw new CategoryNotFoundException("Category with name '{$categoryData->name}' already exists.");
            }
        }

        $category->update([
            'name' => $categoryData->name,
            'status' => $categoryData->status,
        ]);
    }

    public function delete(Category $category): void
    {
        $category->delete();
    }
}
