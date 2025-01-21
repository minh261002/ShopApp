<?php

namespace App\Admin\Services\Product;

use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductService implements ProductServiceInterface
{
    protected $repository;

    public function __construct(
        ProductRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    public function store(Request $request): void
    {
        $data = $request->validated();

        $categoryIds = $data['category_id'];
        unset($data['category_id']);

        if ($data['image'] == null) {
            $data['image'] = '/admin/images/not-found.jpg';
        }

        if ($data['gallery'] !== null) {
            $data['gallery'] = json_encode($data['gallery']);
        }

        $product = $this->repository->create($data);
        $product->categories()->attach($categoryIds);

        return;
    }

    public function update(Request $request): void
    {
        //
    }
}