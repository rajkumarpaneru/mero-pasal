<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSellerRequest;
use App\Http\Resources\SellerResource;
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
        $seller = $this->sellerService->store($validated);
        $response = SellerResource::make($seller);

        return response()->json($response);
    }
}
