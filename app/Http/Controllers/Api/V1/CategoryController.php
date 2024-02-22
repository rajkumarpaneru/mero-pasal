<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    public function index(): JsonResponse
    {
        $categories = Category::paginate(10);
        $response = CategoryResource::collection($categories);
        return $this->successResponse('Categories retrieved successfully.', $response);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|max:191|unique:categories,name',
            'rank' => 'required|integer|min:1',
        ]);

        $category = Category::create($validated);

        $response = CategoryResource::make($category);

        return $this->successResponse("Category created successfully.", $response);
    }

    public function show(Category $category): JsonResponse
    {
        $response = CategoryResource::make($category);
        return $this->successResponse("Category retrieved successfully.", $response);
    }

    public function update(Category $category, Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|max:191|unique:categories,name,' . $category->id,
            'rank' => 'required|integer|min:1',
        ]);

        $category->update($validated);
        $response = CategoryResource::make($category->refresh());

        return $this->successResponse('Category updated successfully.', $response);
    }

    public function destroy(Category $category): JsonResponse
    {
        $category->delete();
        return $this->successResponse('Category deleted successfully.', null);
    }
}
