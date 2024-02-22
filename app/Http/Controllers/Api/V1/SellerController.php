<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSellerRequest;
use App\Http\Requests\UpdateSellerRequest;
use App\Http\Resources\SellerResource;
use App\Models\Seller;
use App\Services\SellerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    private $sellerService;

    public function __construct(SellerService $sellerService)
    {
        $this->sellerService = $sellerService;
    }

    public function store(StoreSellerRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $validated['user_id'] = $request->user()->id;
        $validated['verified_at'] = null;
        $validated['status'] = 'pending';
        $seller = $this->sellerService->store($validated);
        $response = SellerResource::make($seller);

        return response()->json($response);
    }

    public function update(Seller $seller, UpdateSellerRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $this->sellerService->update($seller, $validated);

        $response = SellerResource::make($seller->refresh());

        return response()->json($response);
    }
}
