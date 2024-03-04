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
            'sub_category' => NameResource::make($this->sub_category),
            'brand' => NameResource::make($this->brand),
            'seller' => NameResource::make($this->seller),
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
            'features' => ProductFeatureResource::collection($this->features),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
