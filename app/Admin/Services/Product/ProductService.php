<?php

namespace App\Admin\Services\Product;

use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Product\ProductVariationRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductService implements ProductServiceInterface
{
    protected $repository;
    protected $productVariationRepository;

    public function __construct(
        ProductRepositoryInterface $repository,
        ProductVariationRepositoryInterface $productVariationRepository
    ) {
        $this->repository = $repository;
        $this->productVariationRepository = $productVariationRepository;
    }

    public function store(Request $request)
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

        return $product;
    }

    public function update(Request $request)
    {
        $data = $request->validated();
        $product = $this->repository->findOrFail($data['id']);

        $categoryIds = $data['category_id'];
        unset($data['category_id']);

        if ($data['image'] == null) {
            $data['image'] = '/admin/images/not-found.jpg';
        }

        if ($data['gallery'] !== null) {
            $data['gallery'] = json_encode($data['gallery']);
        }

        $product->update($data);
        $product->categories()->sync($categoryIds);

        return;
    }

    public function variationStore(Request $request)
    {
        $data = $request->validated();

        $attributes = $data['attributes'];
        unset($data['attributes']);

        $variation = $this->productVariationRepository->create($data);

        $valuesToInsert = [];

        foreach ($attributes as $attributeId => $value) {
            $valuesToInsert[] = [
                'product_variation_id' => $variation->id,
                'variation_attribute_id' => $attributeId,
                'value' => $value,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('product_variations_values')->insert($valuesToInsert);
        return $variation;
    }


    public function variationUpdate(Request $request)
    {
        $data = $request->validated();
        $variation = $this->productVariationRepository->findOrFail($data['id']);

        $attributes = $data['attributes'];
        unset($data['attributes']);

        $variation->update($data);

        $valuesToInsert = [];

        foreach ($attributes as $attributeId => $value) {
            $valuesToInsert[] = [
                'product_variation_id' => $variation->id,
                'variation_attribute_id' => $attributeId,
                'value' => $value,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('product_variations_values')->where('product_variation_id', $variation->id)->delete();
        DB::table('product_variations_values')->insert($valuesToInsert);

        return $variation;
    }
}