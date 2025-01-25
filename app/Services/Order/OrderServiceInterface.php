<?php

namespace App\Services\Order;

use Illuminate\Http\Request;

interface OrderServiceInterface
{
    public function store(Request $request);
}