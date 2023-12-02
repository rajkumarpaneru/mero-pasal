<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index(Category $category): JsonResponse
    {
        $sub_categories = $category->subCategories;
        return response()->json($sub_categories);
    }

    public function store(Category $category, Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|max:191',
            'rank' => 'required|integer|min:1',
        ]);

        $sub_category = $category->subCategories()->create($validated);

        return response()->json($sub_category);
    }

    public function show(Category $category, $id): JsonResponse
    {
        $subCategory = $category->subCategories()
            ->where('sub_categories.id', $id)->firstOrFail();
        return response()->json($subCategory);
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
        $subCategory->refresh();

        return response()->json($subCategory);
    }

    public function destroy(Category $category, $id): JsonResponse
    {
        $subCategory = $category->subCategories()
            ->where('sub_categories.id', $id)->firstOrFail();

        $subCategory->delete();
        return response()->json(null, 204);
    }
}