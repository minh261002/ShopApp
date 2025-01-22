<?php

namespace App\Api\V1\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'province_id' => $this->province_id,
            'district_id' => $this->district_id,
            'ward_id' => $this->ward_id,
            'address' => $this->address,
            'image' => formatImageUrl($this->image),
            'birday' => formatDate($this->birthday),
            'description' => $this->description,
            'status' => $this->status,
            'login_type' => $this->login_type,
        ];
    }
}
