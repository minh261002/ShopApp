<?php

namespace App\Models;

use App\Enums\ActiveStatus;
use App\Supports\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, Sluggable, SoftDeletes;

    protected $guarded = [];

    protected $table = 'products';

    protected $casts = [
        'status' => ActiveStatus::class
    ];

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(VariationAttribute::class, 'product_variations_values', 'product_variation_id', 'variation_attribute_id')
            ->withPivot('value')
            ->withTimestamps();
    }
}