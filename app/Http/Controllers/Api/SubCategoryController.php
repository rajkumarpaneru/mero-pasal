<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\SubCategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SubCategoryController extends BaseController
{
    public function index(Category $category): JsonResponse
    {
        $subCategories = $category->subCategories;
        $response = SubCategoryResource::collection($subCategories);
        return $this->successResponse('Sub categories retrieved successfully.', $response);
    }

    public function store(Category $category, Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|max:191',
            'rank' => 'required|integer|min:1',
        ]);

        $subCategory = $category->subCategories()->create($validated);

        $response = SubCategoryResource::make($subCategory);
        return $this->successResponse('Sub category stored successfully.', $response);
    }

    public function show(Category $category, $id): JsonResponse
    {
        $subCategory = $category->subCategories()
            ->where('sub_categories.id', $id)->firstOrFail();
        $response = SubCategoryResource::make($subCategory);
        return $this->successResponse('Sub category retrieved successfully.', $response);
    }

    public function update(Request $request, Category $category, $id): JsonResponse
    {
        $subCategory = $category->subCategories()
            ->where('sub_categories.id', $id)->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|max:191|unique:categories,name,' . $category->id,
            'rank' => 'required|integer|min:1',
        ]);

        $subCategory->update($validated);

        $response = SubCategoryResource::make($subCategory->refresh());
        return $this->successResponse('Sub category updated successfully.', $response);
    }

    public function destroy(Category $category, $id): JsonResponse
    {
        $subCategory = $category->subCategories()
            ->where('sub_categories.id', $id)->firstOrFail();

        $subCategory->delete();
        return $this->successResponse('Sub category deleted successfully.', null);
    }
}
