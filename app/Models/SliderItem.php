<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SliderItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'slider_items';

    protected $guarded = [];

    public function slider()
    {
        return $this->belongsTo(Slider::class);
    }
}