<?php

namespace App\Admin\Http\Controllers\Product;

use App\Admin\DataTables\Product\ProductVariationDataTable;
use App\Admin\Http\Requests\Product\ProductVariationRequest;
use App\Admin\Services\Product\ProductServiceInterface;
use App\Http\Controllers\Controller;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Product\ProductVariationRepositoryInterface;
use App\Repositories\Product\ProductVariationValueRepositoryInterface;
use App\Repositories\Product\VariationAttributeRepositoryInterface;

class ProductVariationController extends Controller
{
    protected $service;
    protected $repository;
    protected $productRepository;
    protected $variationAttributeRepository;
    protected $productVariationValueRepository;

    public function __construct(
        ProductServiceInterface $service,
        ProductVariationRepositoryInterface $repository,
        ProductRepositoryInterface $productRepository,
        VariationAttributeRepositoryInterface $variationAttributeRepository,
        ProductVariationValueRepositoryInterface $productVariationValueRepository
    ) {
        $this->service = $service;
        $this->repository = $repository;
        $this->productRepository = $productRepository;
        $this->variationAttributeRepository = $variationAttributeRepository;
        $this->productVariationValueRepository = $productVariationValueRepository;
    }

    public function index(ProductVariationDataTable $dataTable)
    {
        return $dataTable->render('admin.product.variation.index');
    }

    public function create($id)
    {
        $product = $this->productRepository->findOrFail($id);
        $variationAttributes = $this->variationAttributeRepository->getAll();
        return view('admin.product.variation.create', compact('product', 'variationAttributes'));
    }

    public function store(ProductVariationRequest $request)
    {
        $variation = $this->service->variationStore($request);
        return redirect()->route('admin.product.variation.index', $variation->product_id)->with('success', 'Thêm biến thể sản phẩm thành công');
    }

    public function edit($id)
    {
        $variationAttributes = $this->variationAttributeRepository->getAll();
        $variation = $this->repository->findOrFail($id)->with('variationAttributes')->where('id', $id)->first();

        $variationValues = $variation->variationAttributes->pluck('pivot.value', 'id');
        return view('admin.product.variation.edit', compact('variation', 'variationAttributes', 'variationValues'));
    }

    public function update(ProductVariationRequest $request)
    {
        $variation = $this->service->variationUpdate($request);
        return redirect()->route('admin.product.variation.index', $variation->product_id)->with('success', 'Cập nhật biến thể sản phẩm thành công');
    }

    public function delete($id)
    {
        $this->repository->delete($id);
        return response()->json(['status' => 'success', 'message' => 'Xóa biến thể sản phẩm thành công']);
    }
}