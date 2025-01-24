<?php

namespace App\Http\Controllers;

use App\Enums\ActiveStatus;
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
    protected $categoryRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        ProductVariationValueRepositoryInterface $productVariationValueRepository,
        VariationAttributeRepositoryInterface $variationAttributeRepository,
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->productRepository = $productRepository;
        $this->productVariationValueRepository = $productVariationValueRepository;
        $this->variationAttributeRepository = $variationAttributeRepository;
        $this->categoryRepository = $categoryRepository;
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

        $categories = $this->categoryRepository->getByQueryBuilder([
            'status' => ActiveStatus::Active->value,
            'parent_id' => null
        ])->defaultOrder()->withDepth()->get()->toFlatTree();

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

        if ($request->has('category')) {
            $query->whereHas('categories', function ($query) use ($request) {
                $query->where('slug', $request->get('category'));
            });
        }


        $products = $query->paginate(1)->withQueryString();
        return view('client.product.index', compact('products', 'attributes', 'categories'));
    }

    public function get(Request $request)
    {
        $product_id = $request->get('product_id');
        $data = $request->get('data');

        $product = $this->productRepository->getByQueryBuilder([
            'id' => $product_id
        ], [
            'variations',
        ])->first();

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $variation = $product->variations->filter(function ($variation) use ($data) {

            foreach ($data as $attributeName => $attributeValue) {

                $hasAttribute = $variation->variationAttributes->contains(function ($attribute) use ($attributeName, $attributeValue) {
                    return $attribute->slug == $attributeName && $attribute->pivot->value == $attributeValue;
                });


                if (!$hasAttribute) {
                    return false;
                }
            }
            return true;
        })->first();


        if (!$variation) {
            return response()->json(['message' => 'Variation not found'], 404);
        }

        return response()->json([
            'variation' => $variation,
        ]);
    }



}
