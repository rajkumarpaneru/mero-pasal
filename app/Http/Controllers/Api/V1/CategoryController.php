<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    public function index(): JsonResponse
    {
        $categories = Category::get();
        return response()->json($categories);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|max:191|unique:categories,name',
            'rank' => 'required|integer|min:1',
        ]);

        $category = Category::create($validated);

        return response()->json($category);
    }

    public function show(Category $category): JsonResponse
    {
        return response()->json($category);
    }

    public function update(Request $request, Category $category): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|max:191|unique:categories,name,' . $category->id,
            'rank' => 'required|integer|min:1',
        ]);

        $category->update($validated);
        $category->refresh();

        return response()->json($category);
    }

    public function destroy(Category $category):JsonResponse
    {
        $category->delete();
        return response()->json(null, 204);
    }
}
