<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductController extends BaseController
{
    public function show(Product $product)
    {
        $response = ProductResource::make($product);
        return $this->successResponse("Product retrieved successfully.", $response);
    }

}
