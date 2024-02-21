<?php

namespace App\Services;

use App\Models\Seller;

class SellerService
{

    public function store($validated): Seller
    {
        return Seller::first();
    }
}
