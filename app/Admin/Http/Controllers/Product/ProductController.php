<?php

namespace App\Admin\Http\Controllers\Product;

use App\Admin\DataTables\Product\ProductDataTable;
use App\Admin\Http\Requests\Product\ProductRequest;
use App\Admin\Services\Product\ProductServiceInterface;
use App\Enums\ActiveStatus;
use App\Http\Controllers\Controller;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Product\VariationAttributeRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $service;
    protected $repository;
    protected $variationAttributeRepository;

    public function __construct(
        ProductServiceInterface $service,
        ProductRepositoryInterface $repository,
        VariationAttributeRepositoryInterface $variationAttributeRepository
    ) {
        $this->service = $service;
        $this->repository = $repository;
        $this->variationAttributeRepository = $variationAttributeRepository;
    }

    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('admin.product.index');
    }

    public function create()
    {
        $variationAttributes = $this->variationAttributeRepository->getAll();
        $status = ActiveStatus::asSelectArray();

        return view('admin.product.create', compact('status', 'variationAttributes'));
    }

    public function store(ProductRequest $request)
    {
        $this->service->store($request);
        return redirect()->route('admin.product.index')->with('success', 'Thêm sản phẩm thành công');
    }

    public function edit($id)
    {
        $product = $this->repository->findOrFail($id);
        $variationAttributes = $this->variationAttributeRepository->getAll();
        $status = ActiveStatus::asSelectArray();

        return view('admin.product.edit', compact('product', 'status', 'variationAttributes'));
    }

    public function update(ProductRequest $request)
    {
        $this->service->update($request);
        return redirect()->route('admin.product.index')->with('success', 'Cập nhật sản phẩm thành công');
    }

    public function updateStatus(Request $request)
    {
        $data = $request->only('id', 'status');
        $this->repository->update($data['id'], $data);
        return response()->json(['status' => 'success', 'message' => 'Cập nhật trạng thái thành công']);
    }

    public function delete($id)
    {
        $this->repository->delete($id);
        return response()->json(['status' => 'success', 'message' => 'Xóa chuyên mục bài viết thành công']);
    }
}