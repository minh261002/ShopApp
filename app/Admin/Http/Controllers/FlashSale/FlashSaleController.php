<?php
namespace App\Admin\Http\Controllers\FlashSale;

use App\Admin\DataTables\FlashSale\FlashSaleDataTable;
use App\Admin\Http\Requests\FlashSale\FlashSaleRequest;
use App\Admin\Services\FlashSale\FlashSaleServiceInterface;
use App\Enums\ActiveStatus;
use App\Http\Controllers\Controller;
use App\Repositories\FlashSale\FlashSaleItemRepositoryInterface;
use App\Repositories\FlashSale\FlashSaleRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Http\Request;

class FlashSaleController extends Controller
{
    protected $repository;
    protected $itemRepository;
    protected $productRepository;
    protected $service;

    public function __construct(
        FlashSaleRepositoryInterface $repository,
        FlashSaleItemRepositoryInterface $itemRepository,
        ProductRepositoryInterface $productRepository,
        FlashSaleServiceInterface $service
    ) {
        $this->repository = $repository;
        $this->itemRepository = $itemRepository;
        $this->productRepository = $productRepository;
        $this->service = $service;
    }

    public function index(FlashSaleDataTable $dataTable)
    {
        return $dataTable->render('admin.flash_sale.index');
    }

    public function create()
    {
        $status = ActiveStatus::asSelectArray();
        $query = $this->productRepository->getByQueryBuilder(['status' => ActiveStatus::Active]);
        $products = $query->whereNotIn('id', $this->itemRepository->getQueryBuilderOrderBy()->pluck('product_id'))->get();
        return view('admin.flash_sale.create', compact('status', 'products'));
    }

    public function store(FlashSaleRequest $request)
    {
        $this->service->store($request);
        return redirect()->route('admin.flash_sale.index');
    }

    public function edit($id)
    {
        $status = ActiveStatus::asSelectArray();
        $flashSale = $this->repository->find($id);
        $products = $this->productRepository->getByQueryBuilder(['status' => ActiveStatus::Active])->get();
        return view('admin.flash_sale.edit', compact('status', 'flashSale', 'products'));
    }
    public function update(FlashSaleRequest $request)
    {
        $this->service->update($request);
        return redirect()->route('admin.flash_sale.index')->with('success', 'Cập nhật mã giảm giá thành công');
    }

    public function updateStatus(Request $request)
    {
        $data = $request->only('id', 'status');
        $this->repository->update($data['id'], $data);
        return response()->json(['status' => 'success', 'message' => 'Cập nhật trạng thái thành công']);
    }

    public function delete(int $id)
    {
        $this->repository->delete($id);
        return response()->json(['status' => 'success', 'message' => 'Xóa module thành công']);
    }
}
