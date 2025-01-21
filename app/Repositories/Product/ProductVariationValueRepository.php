<?php

namespace App\Repositories\Product;

use App\Models\ProductVariationValue;
use App\Repositories\BaseRepository;

class ProductVariationValueRepository extends BaseRepository implements ProductVariationValueRepositoryInterface
{
    public function getModel()
    {
        return ProductVariationValue::class;
    }
}