<?php

namespace App\Models;

use App\Enums\Module\ModuleStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'modules';

    protected $guarded = [];

    protected $casts = [
        'status' => ModuleStatus::class,
    ];
}