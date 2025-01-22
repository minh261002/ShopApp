<?php

namespace App\Api\V1\Http\Resources\Product;

use App\Enums\ActiveStatus;
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
            'price' => $this->variations->first()->price ?? 0,
            'sale_price' => $this->variations->first()->sale_price ?? 0,
            'variations' => ShowProductVariationResource::collection($this->variations),
        ];

        if ($this->flashSale && $this->flashSale->count() > 0 && $this->flashSale->first()->status->value == ActiveStatus::Active->value && $this->flashSale->first()->end_date > now()) {
            $data['flashSale'] = $this->flashSale->map(function ($flashSale) {
                return [
                    'id' => $flashSale->id,
                    'title' => $flashSale->title,
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
}
