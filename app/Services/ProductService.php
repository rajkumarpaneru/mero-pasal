<?php


namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function store(array $validated): Product
    {
        $product = Product::create([
            'sub_category_id' => $validated['sub_category_id'],
            'brand_id' => $validated['brand_id'],
            'name' => $validated['name'],
            'price' => $validated['price'],
            'description' => $validated['description'] ?? null
        ]);

        if (isset($validated['product_features']) && count($validated['product_features']) > 0) {
            foreach ($validated['product_features'] as $key => $feature) {
                $product->productFeatures()->create([
                    'feature' => $feature,
                    'rank' => $key + 1
                ]);
            }
        }

        return $product;
    }

    public function update(Product $product, array $validated): void
    {
        $product->update([
            'sub_category_id' => $validated['sub_category_id'],
            'brand_id' => $validated['brand_id'],
            'name' => $validated['name'],
            'price' => $validated['price'],
            'description' => $validated['description'] ?? null
        ]);

        $product->productFeatures()->delete();

        if (isset($validated['product_features']) && count($validated['product_features']) > 0) {
            foreach ($validated['product_features'] as $key => $feature) {
                $product->productFeatures()->create([
                    'feature' => $feature,
                    'rank' => $key + 1
                ]);
            }
        }

    }
}
