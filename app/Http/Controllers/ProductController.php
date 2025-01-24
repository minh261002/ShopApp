<?php

namespace App\Http\Controllers;

use App\Enums\ActiveStatus;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Product\ProductVariationValueRepositoryInterface;
use App\Repositories\Product\VariationAttributeRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productRepository;
    protected $productVariationValueRepository;
    protected $variationAttributeRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        ProductVariationValueRepositoryInterface $productVariationValueRepository,
        VariationAttributeRepositoryInterface $variationAttributeRepository
    ) {
        $this->productRepository = $productRepository;
        $this->productVariationValueRepository = $productVariationValueRepository;
        $this->variationAttributeRepository = $variationAttributeRepository;
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

    public function index(Request $request)
    {

        $attributes = $this->variationAttributeRepository->getByQueryBuilder(
            [],
            ['values']
        )->get();

        $query = $this->productRepository->getQueryBuilderOrderBy();

        if ($request->has('mau-sac')) {
            $query->whereHas('variations', function ($query) use ($request) {
                $query->whereHas('variationAttributes', function ($query) use ($request) {
                    $query->where('name', 'Màu sắc')->where('value', $request->get('mau-sac'));
                });
            });
        }

        if ($request->has('kich-thuoc')) {
            $query->whereHas('variations', function ($query) use ($request) {
                $query->whereHas('variationAttributes', function ($query) use ($request) {
                    $query->where('name', 'Kích thước')->where('value', $request->get('kich-thuoc'));
                });
            });
        }

        if ($request->has('price')) {
            $price = explode('-', $request->get('price'));
            $from = (int) $price[0];
            $to = (int) $price[1];
            $query->where(function ($query) use ($from, $to) {
                $query->whereHas('variations', function ($query) use ($from, $to) {
                    $query->where('sale_price', '>', 0)->whereBetween('sale_price', [$from, $to]);
                })->orWhereHas('variations', function ($query) use ($from, $to) {
                    $query->where('price', '>', 0)->whereBetween('price', [$from, $to]);
                });
            });
        }


        $products = $query->paginate(12);

        return view('client.product.index', compact('products', 'attributes'));
    }
}