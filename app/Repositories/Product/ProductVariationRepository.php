<?php

namespace App\Repositories\Product;

use App\Models\ProductVariation;
use App\Repositories\BaseRepository;

class ProductVariationRepository extends BaseRepository implements ProductVariationRepositoryInterface
{
    public function getModel()
    {
        return ProductVariation::class;
    }
}