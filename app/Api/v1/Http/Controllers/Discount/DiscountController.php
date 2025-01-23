<?php

namespace App\Api\V1\Http\Controllers\Discount;

use App\Api\V1\Http\Resources\Discount\DiscountResource;
use App\Repositories\Discount\DiscountRepositoryInterface;
use App\Http\Controllers\Controller;


/**
 * @group Mã giảm giá
 */

class DiscountController extends Controller
{
    protected $repository;
    protected $service;

    public function __construct(
        DiscountRepositoryInterface $repository,
    ) {
        $this->repository = $repository;
    }

    /**
     * Mã hiển thị lên trang chủ
     *
     * Api này trả về tất cả mã giảm giá hiển thị lên trang chủ
     *
     * @return \Illuminate\Http\Response
     */

    public function showHome()
    {
        try {
            $discounts = $this->repository->getByQueryBuilder(['show_home' => true])->get();
            return response()->json([
                'data' => DiscountResource::collection($discounts)
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
