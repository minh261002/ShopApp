<?php

namespace App\Api\V1\Http\Resources\Category;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryHomeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'image' => formatImageUrl($this->image),
        ];
    }
}
