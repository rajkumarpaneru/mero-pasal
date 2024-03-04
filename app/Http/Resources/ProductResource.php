<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'sub_category' => [
                'id' => $this->sub_category->id,
                'name' => $this->sub_category->name,
            ],
            'brand' => [
                'id' => $this->brand->id,
                'name' => $this->brand->name
            ],
            'seller' => [
                'id' => $this->seller->id,
                'name' => $this->seller->name
            ],
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
            'features' => ProductFeatureResource::collection($this->features),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
