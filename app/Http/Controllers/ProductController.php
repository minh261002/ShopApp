<?php

namespace App\Http\Controllers;

use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository
    ) {
        $this->productRepository = $productRepository;
    }

    public function show($slug)
    {
        $product = $this->productRepository->getByQueryBuilder([
            'slug' => $slug
        ], [
            'categories',
            'variations',
        ])->first();

        $groupedAttributes = collect($product->variations->pluck('variationAttributes')->flatten(1)->groupBy('name'))
            ->mapWithKeys(function ($item, $key) {
                return [$key => collect($item)->pluck('pivot.value')->unique()->values()];
            });

        $relatedProducts = $product->categories->first()->products()->where('id', '!=', $product->id)->get();

        return view('client.product.show', compact('product', 'groupedAttributes', 'relatedProducts'));
    }
}