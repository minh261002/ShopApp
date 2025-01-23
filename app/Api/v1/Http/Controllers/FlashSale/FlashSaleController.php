<?php

namespace App\Api\V1\Http\Controllers\FlashSale;

use App\Api\V1\Http\Resources\FlashSale\FlashSaleResource;
use App\Http\Controllers\Controller;
use App\Repositories\FlashSale\FlashSaleRepositoryInterface;
use Illuminate\Http\JsonResponse;

/**
 * @group Flash Sale
 */

class FlashSaleController extends Controller
{
    protected $repository;

    public function __construct(
        FlashSaleRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * Danh sách chương trình khuyến mãi
     * @return \Illuminate\Http\JsonResponse
     */

    public function index(): JsonResponse
    {
        try {
            $flashSales = $this->repository->getQueryBuilderOrderBy()->active()->get();
            return response()->json([
                'data' => FlashSaleResource::collection($flashSales)
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}