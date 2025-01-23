<?php

namespace App\Api\V1\Http\Controllers\Slider;

use App\Api\V1\Http\Resources\Slider\SliderResource;
use App\Repositories\Slider\SliderRepositoryInterface;
use App\Enums\ActiveStatus;
use App\Http\Controllers\Controller;

/**
 * @group Slider
 */

class SliderController extends Controller
{
    protected $repository;

    public function __construct(SliderRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Danh sách slider
     *
     * Api này trả về danh sách tất cả slider đang hoạt động
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function index()
    {
        try {
            $sliders = $this->repository->getByQueryBuilder(['status' => ActiveStatus::Active], ['items'])->get();

            return response()->json([
                'status' => 200,
                'data' => SliderResource::collection($sliders)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Chi tiết slider
     *
     * Api này trả về chi tiết slider theo key
     *
     * @urlParam key integer required key của slider
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */

    public function show($key)
    {
        try {
            $slider = $this->repository->getByQueryBuilder(['key' => $key, 'status' => ActiveStatus::Active->value], ['items'])->first();
            return response()->json([
                'status' => 200,
                'data' => new SliderResource($slider)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }
}