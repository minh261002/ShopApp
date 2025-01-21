<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariationAttribute extends Model
{
    use HasFactory;

    protected $table = 'variation_attributes';

    protected $guarded = [];

    public function productVariations()
    {
        return $this->belongsToMany(
            ProductVariation::class,
            'product_variations_values',
            'variation_attribute_id',
            'product_variation_id'
        )->withPivot('value');
    }
}