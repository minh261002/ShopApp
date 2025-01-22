<?php

namespace App\Api\V1\Http\Resources\Product;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AllProductResource extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->map(function ($product) {
            $data = [
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'image' => formatImageUrl($product->image),
            ];

            return $data;
        })->toArray();
    }
}
