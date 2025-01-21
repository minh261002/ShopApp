<?php

namespace App\Admin\Services\Product;

use Illuminate\Http\Request;

interface ProductServiceInterface
{
    public function store(Request $request): void;

    public function update(Request $request): void;
}