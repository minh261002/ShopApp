<?php

namespace App\Api\V1\Http\Resources\Category;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryMenuResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            '_lft' => $this->_lft,
            '_rgt' => $this->_rgt,
            'parent_id' => $this->parent_id,
            'name' => $this->name,
            'slug' => $this->slug,
            'position' => $this->position,
            'children' => CategoryMenuResource::collection($this->whenLoaded('children')), // Load danh mục con
        ];
    }
}