<?php

namespace App\Api\V1\Http\Resources\FlashSale;

use App\Api\V1\Http\Resources\Product\AllProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

class FlashSaleProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'discount' => $this->discount,
            'image' => $this->image ? formatImageUrl($this->image) : null,
            'sold' => $this->sold,
            'product' => new AllProductResource($this->product()->get()),
        ];
    }
}