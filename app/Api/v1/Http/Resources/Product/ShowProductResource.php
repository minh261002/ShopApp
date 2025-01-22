<?php

namespace App\Api\V1\Http\Resources\Product;

use App\Enums\Attribute\AttributeType;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowProductResource extends JsonResource
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
            'name' => $this->name,
            'slug' => $this->slug,
            'quantity' => $this->quantity,
            'image' => formatImageUrl($this->image),
            'gallery' => $this->getGallery($this->gallery),
            'categories' => $this->categories->map(function ($category) {
                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'slug' => $category->slug,
                ];
            }),
            'desc' => $this->desc,
            'meta_title' => $this->meta_title,
            'meta_desc' => $this->meta_desc,
            'meta_keywords' => $this->meta_keywords,
            'variations' => ShowProductVariationResource::collection($this->productVariations),
        ];

        if ($this->flashSale && $this->flashSale->count() > 0 && $this->flashSale->first()->status == 2 && $this->flashSale->first()->end_date > now()) {
            $data['flashSale'] = $this->flashSale->map(function ($flashSale) {
                return [
                    'id' => $flashSale->id,
                    'title' => $flashSale->title,
                    'start_date' => $flashSale->start_date,
                    'end_date' => $flashSale->end_date,
                    'product' => $flashSale->items->where('product_id', $this->id)->map(function ($item) {
                        return [
                            'discount' => $item->discount,
                            'image' => formatImageUrl($item->image),
                        ];
                    })->first()
                ];
            });
        }

        if ($this->type == 1) {

            $data['price'] = $this->price;
            $data['sale_price'] = $this->sale_price;

        } elseif ($this->productAttributes) {
            $data['attributes'] = $this->productAttributes->map(function ($productAttribute) {
                return $this->handleAttribute($productAttribute);
            });
        }
        return $data;
    }

    private function getGallery($gallery)
    {
        if ($gallery == null) {
            return [formatImageUrl('/admin/images/not-found.jpg')];
        }

        $gallery = json_decode($gallery);
        return array_map(function ($image) {
            return formatImageUrl($image);
        }, $gallery);
    }

    private function handlePriceVariation()
    {
        $data = [];
        if ($this->productVariations) {
            if ($this->productVariations->count() == 1) {
                $data['price'] = $this->productVariations[0]->price;
                $data['sale_price'] = $this->productVariations[0]->sale_price;
            } elseif ($this->productVariations->count() > 1) {
                $price_variation = array_column($this->productVariations->toArray(), 'price');
                $sale_price_variation = array_column($this->productVariations->toArray(), 'sale_price');

                $data['min_promotion_price'] = min($sale_price_variation);
                $data['min_price'] = min($price_variation);
                $data['max_price'] = max($price_variation);
            }
        }
        return $data;
    }

    private function handleAttribute($productAttribute)
    {
        $attribute = $productAttribute->attribute;
        $attributesVariations = $productAttribute->attributeVariations;
        $productAttribute = [];

        $productAttribute = [
            'id' => $attribute->id,
            'type' => $attribute->type,
            'name' => $attribute->name,
        ];
        $productAttribute['variations'] = $attributesVariations->map(function ($attributesVariation) use ($productAttribute) {
            return [
                'id' => $attributesVariation->id,
                'name' => $attributesVariation->name,
                'meta_value' => $productAttribute['type'] == 1 ? $attributesVariation->meta_value : null
            ];
        });

        return $productAttribute;
    }
}
