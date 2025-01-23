<?php

namespace App\Api\V1\Http\Resources\Slider;

use Illuminate\Http\Resources\Json\JsonResource;

class SliderItemResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'link' => $this->link,
            'image' => formatImageUrl($this->image),
            'mobile_image' => formatImageUrl($this->mobile_image),
        ];
    }
}
