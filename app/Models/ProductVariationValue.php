<?php

namespace App\Models;

use App\Supports\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVariationValue extends Model
{
    use HasFactory, Sluggable, SoftDeletes;

    protected $table = 'product_variations_values';

    protected $guarded = [];

    public function variation()
    {
        return $this->belongsTo(ProductVariation::class, 'product_variation_id');
    }

    public function attribute()
    {
        return $this->belongsTo(VariationAttribute::class, 'variation_attribute_id');
    }

    public function product()
    {
        return $this->variation->product;
    }
}