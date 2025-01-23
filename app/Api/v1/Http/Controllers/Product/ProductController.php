<?php

namespace App\Api\V1\Http\Controllers\Product;

use App\Api\V1\Http\Resources\Product\AllProductResource;
use App\Api\V1\Http\Resources\Product\ShowProductResource;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Enums\ActiveStatus;
use App\Http\Controllers\Controller;

/**
 * @group Sản phẩm
 */

class ProductController extends Controller
{
    protected $repository;

    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Chi tiết sản phẩm
     *
     * Api này trả về thông tin chi tiết của sản phẩm
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function show($slug)
    {
        try {
            $product = $this->repository->getByQueryBuilder(['slug' => $slug])->first();

            return response()->json([
                'status' => 200,
                'data' => new ShowProductResource($product)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Sản phẩm mới
     * @return void
     */
    public function new()
    {
        try {
            $products = $this->repository->getByQueryBuilder(['status' => ActiveStatus::Active->value], ['categories'])->where('created_at', '>=', now()->subDays(10))->get();
            return response()->json([
                'status' => 200,
                'data' => new AllProductResource($products)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }
}
