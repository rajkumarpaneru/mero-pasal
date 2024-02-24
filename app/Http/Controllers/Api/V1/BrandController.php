<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BrandController extends BaseController
{
    public function index(): JsonResponse
    {
        $brands = Brand::paginate(10);
        $response = BrandResource::collection($brands);
        return $this->successResponse('Brands retrieved successfully.', $response);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|max:191|unique:brands,name',
            'rank' => 'required|integer|min:1',
        ]);

        $brand = Brand::create($validated);

        $response = BrandResource::make($brand);

        return $this->successResponse("Brand created successfully.", $response);
    }

    public function show(Brand $brand): JsonResponse
    {
        $response = BrandResource::make($brand);
        return $this->successResponse("Brand retrieved successfully.", $response);
    }

    public function update(Brand $brand, Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|max:191|unique:brands,name,' . $brand->id,
            'rank' => 'required|integer|min:1',
        ]);

        $brand->update($validated);
        $response = BrandResource::make($brand->refresh());

        return $this->successResponse('Brand updated successfully.', $response);
    }

    public function destroy(Brand $brand): JsonResponse
    {
        $brand->delete();
        return $this->successResponse('Brand deleted successfully.', null);
    }
}
