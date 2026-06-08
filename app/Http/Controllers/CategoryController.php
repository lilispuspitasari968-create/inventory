<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;

class CategoryController extends BaseController
{
    public function index()
    {
        $categories = Category::withCount('items')->get();
        return $this->success($categories, 'Categories retrieved successfully');
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->validated());
        return $this->success($category, 'Category created successfully', 201);
    }

    public function show($id)
    {
        $category = Category::withCount('items')->find($id);
        if (!$category) return $this->error('Category not found', 404);
        return $this->success($category, 'Category retrieved successfully');
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = Category::find($id);
        if (!$category) return $this->error('Category not found', 404);
        $category->update($request->validated());
        return $this->success($category, 'Category updated successfully');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if (!$category) return $this->error('Category not found', 404);
        $category->delete();
        return $this->success([], 'Category deleted successfully');
    }
}