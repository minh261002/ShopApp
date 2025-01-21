<?php

namespace App\Admin\Services\FlashSale;
use Illuminate\Http\Request;

interface FlashSaleServiceInterface
{
    public function store(Request $request);
    public function update(Request $request);
}