<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
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

    public function index(): JsonResponse
    {
        $products = Product::query()->paginate(10);

        $response = ProductResource::collection($products);

        return $this->successResponse("Products listed successfully.", $response);
    }

    public function store(StoreProductRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $product = $this->productService->store($validated);

        $response = ProductResource::make($product);

        return $this->successResponse("Product created successfully.", $response);
    }

    public function show(Product $product): JsonResponse
    {
        $response = ProductResource::make($product);
        return $this->successResponse("Product retrieved successfully.", $response);
    }

    public function update(Product $product, UpdateProductRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $this->productService->update($product, $validated);

        $response = ProductResource::make($product->refresh());

        return $this->successResponse("Product updated successfully.", $response);
    }

    public function destroy(Product $product): JsonResponse
    {
        $product->delete();
        return $this->successResponse('Product deleted successfully.');
    }
}
