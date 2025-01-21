<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Discount extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'discounts';

    protected $guarded = [];

    public function discountApps()
    {
        return $this->hasMany(DiscountApplication::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'discount_apps', 'discount_id', 'user_id');
    }


    public function scopeActive($query)
    {
        return $query
            ->where('date_start', '<=', Carbon::now())
            ->where('date_end', '>=', Carbon::now())
            ->where('status', '=', 2)
            ->where(function ($query) {
                $query->where('max_usage', '>', 0)
                    ->orWhereNull('max_usage');
            });
    }

    public function scopeExpired($query)
    {
        return $query->where(function ($query) {
            $query->where('date_end', '<', Carbon::now())
                ->orWhere('max_usage', '=', 0)
                ->orWhereNull('max_usage');
        });
    }
}
