<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $guarded = [];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function status()
    {
        return $this->hasMany(OrderStatus::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class, 'ward_id', 'code');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'code');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'code');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function discounts()
    {
        return $this->belongsToMany(Discount::class, 'discount_applications', 'order_id', 'discount_id');
    }
}