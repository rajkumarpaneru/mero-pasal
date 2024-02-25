<?php


namespace App\Services;


use App\Models\Product;

class ProductService
{
    public function store(array $validated): Product
    {
        return Product::create($validated);
    }
}
