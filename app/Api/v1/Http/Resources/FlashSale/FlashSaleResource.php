<?php

namespace App\Api\V1\Http\Resources\FlashSale;

use Illuminate\Http\Resources\Json\JsonResource;

class FlashSaleResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'start_date' => format_datetime($this->start_date),
            'end_date' => $this->end_date,
            'items' => FlashSaleProductResource::collection($this->items),
        ];
    }
}