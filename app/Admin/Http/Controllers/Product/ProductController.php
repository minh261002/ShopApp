<?php

namespace App\Admin\Http\Controllers\Product;

use App\Admin\Services\Product\ProductServiceInterface;
use App\Http\Controllers\Controller;
use App\Repositories\Product\ProductRepositoryInterface;

class ProductController extends Controller
{
    protected $service;
    protected $repository;

    public function __construct(
        ProductServiceInterface $service,
        ProductRepositoryInterface $repository
    ) {
        $this->service = $service;
        $this->repository = $repository;
    }
}