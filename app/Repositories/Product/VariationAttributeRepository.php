<?php

namespace App\Repositories\Product;

use App\Models\VariationAttribute;
use App\Repositories\BaseRepository;

class VariationAttributeRepository extends BaseRepository implements VariationAttributeRepositoryInterface
{
    public function getModel()
    {
        return VariationAttribute::class;
    }
}