<?php

namespace App\Admin\Services\Order;

use App\Repositories\BaseRepositoryInterface;
use Illuminate\Http\Request;

interface OrderServiceInterface
{
    public function update(Request $request);
}