<?php

namespace App\Api\V1\Http\Controllers\Category;

use App\Api\V1\Http\Resources\Category\CategoryHomeResource;
use App\Api\V1\Http\Resources\Category\CategoryMenuResource;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Enums\ActiveStatus;
use App\Http\Controllers\Controller;
use App\Models\Category;

/**
 * @group Danh mục sản phẩm
 */

class CategoryController extends Controller
{
    protected $repository;

    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Danh sách danh mục sản phẩm trong menu
     *
     * Api này trả về danh sách tất cả danh mục sản phẩm hiển thị trên menu
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @response
     *     {
     * "data": [
     * {
     * "id": 1,
     * "name": "Áo",
     * "slug": "ao",
     * "image": "/admin/images/not-found.jpg"
     * }
     * ]
     * }
     *
     * @return void
     */
    public function getCategoryInMenu()
    {
        try {
            $categories = Category::where('status', ActiveStatus::Active->value)
                ->where('show_menu', true)
                ->whereNull('parent_id')
                ->with('children')
                ->orderBy('position', 'asc')
                ->get();

            return response()->json([
                'data' => CategoryMenuResource::collection($categories)
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Danh sách danh mục sản phẩm trên trang chủ
     *
     * Api này trả về danh sách tất cả danh mục sản phẩm hiển thị trên trang chủ
     *
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function getCategoryInHome()
    {
        try {
            $categories = Category::where('show_home', true)->get();
            return response()->json([
                'data' => CategoryHomeResource::collection($categories)
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}