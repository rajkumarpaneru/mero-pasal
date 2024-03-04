<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\StoreSellerRequest;
use App\Http\Requests\UpdateSellerRequest;
use App\Http\Resources\SellerResource;
use App\Models\Seller;
use App\Services\SellerService;
use Illuminate\Http\JsonResponse;

class SellerController extends BaseController
{
    private $sellerService;

    public function __construct(SellerService $sellerService)
    {
        $this->sellerService = $sellerService;
    }

    public function index(): JsonResponse
    {
        $sellers = Seller::query()->paginate(10);

        $response = SellerResource::collection($sellers);

        return $this->successResponse("Sellers listed successfully.", $response);
    }

    public function store(StoreSellerRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $validated['user_id'] = $request->user()->id;
        $validated['verified_at'] = null;
        $validated['status'] = 'pending';
        $seller = $this->sellerService->store($validated);
        $response = SellerResource::make($seller);

        return $this->successResponse("Seller stored successfully.", $response);
    }

    public function update(Seller $seller, UpdateSellerRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $this->sellerService->update($seller, $validated);

        $response = SellerResource::make($seller->refresh());

        return $this->successResponse("Seller updated successfully.", $response);
    }

    public function show(Seller $seller): JsonResponse
    {
        $response = SellerResource::make($seller);

        return $this->successResponse("Seller retrieved successfully.", $response);
    }

    public function destroy(Seller $seller): JsonResponse
    {
        $seller->delete();

        return $this->successResponse("Seller deleted successfully.", null);
    }
}
