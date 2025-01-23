<?php

namespace App\Models;

use App\Enums\ActiveStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FlashSale extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'flash_sales';

    protected $guarded = [];

    protected $casts = [
        'status' => ActiveStatus::class
    ];

    public function items()
    {
        return $this->hasMany(FlashSaleItem::class, 'flash_sale_id', 'id');
    }


    public function scopeActive($query)
    {
        return $query->where('status', ActiveStatus::Active->value);
    }
}
