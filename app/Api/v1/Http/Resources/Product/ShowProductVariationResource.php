<?php

namespace App\Api\V1\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowProductVariationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'price' => $this->price,
            'sale_price' => $this->sale_price,
            'image' => $this->image ? formatImageUrl($this->image) : null,
            'quantity' => $this->qty,
            'attributes' => $this->attributeVariations->map(function ($attributeVariation) {
                return [
                    'id' => $attributeVariation->id,
                    'attribute_name' => $attributeVariation->attribute->name,
                    'name' => $attributeVariation->name,
                    'meta_value' => $attributeVariation->meta_value,
                ];
            }),
        ];

        return $data;
    }


}
