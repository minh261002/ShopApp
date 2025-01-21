<?php

namespace App\Admin\Services\Product;

use App\Repositories\Product\ProductRepositoryInterface;

class ProductService implements ProductServiceInterface
{
    protected $repository;

    public function __construct(
        ProductRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }
}