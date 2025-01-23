<?php

namespace App\Api\V1\Http\Resources\Discount;

use Illuminate\Http\Resources\Json\JsonResource;

class DiscountResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'date_end'=> formatDate($this->date_end),
            'type' => $this->type,
            'discount_value' => $this->discount_value,
            'percent_value' => $this->percent_value,
            'description' => $this->description,
        ];
    }
}