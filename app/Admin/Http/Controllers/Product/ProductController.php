<?php

namespace App\Admin\Http\Controllers\Product;

use App\Admin\DataTables\Product\ProductDataTable;
use App\Admin\Services\Product\ProductServiceInterface;
use App\Enums\ActiveStatus;
use App\Http\Controllers\Controller;
use App\Repositories\Product\ProductRepositoryInterface;

class ProductController extends Controller
{
    protected $service;
    protected $repository;

    public function __construct(
        ProductServiceInterface $service,
        ProductRepositoryInterface $repository
    ) {
        $this->service = $service;
        $this->repository = $repository;
    }

    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('admin.product.index');
    }

    public function create()
    {
        $status = ActiveStatus::asSelectArray();
        return view('admin.product.create', compact('status'));
    }
}