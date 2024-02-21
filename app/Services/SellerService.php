<?php

namespace App\Services;

use App\Models\Seller;

class SellerService
{

    public function store(array $validated): Seller
    {
        return Seller::create($validated);
    }
}
