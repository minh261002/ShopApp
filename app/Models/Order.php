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

    public function shipping()
    {
        return $this->hasOne(OrderShipping::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }
}