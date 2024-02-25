<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;

class ProductController extends BaseController
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function store(StoreProductRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $product = $this->productService->store($validated);

        $response = ProductResource::make($product);

        return $this->successResponse("Product created successfully.", $response);
    }

    public function show(Product $product)
    {
        $response = ProductResource::make($product);
        return $this->successResponse("Product retrieved successfully.", $response);
    }
}
