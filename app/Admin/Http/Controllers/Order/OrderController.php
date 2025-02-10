<?php

namespace App\Admin\Http\Controllers\Order;

use App\Admin\DataTables\Order\OrderDataTable;
use App\Admin\Http\Requests\Order\OrderUpdateRequest;
use App\Admin\Services\Order\OrderServiceInterface;
use App\Enums\Order\OrderStatus;
use App\Enums\Order\PaymentMethod;
use App\Enums\Order\PaymentStatus;
use App\Enums\Order\ShippingMethod;
use App\Enums\Order\ShippingStatus;
use App\Http\Controllers\Controller;
use App\Repositories\Order\OrderRepositoryInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $repository;
    protected $service;
    protected $userRepository;
    public function __construct(
        OrderRepositoryInterface $repository,
        OrderServiceInterface $service
    ) {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index(OrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.index');
    }

    public function edit($id)
    {
        $order = $this->repository->findOrFail($id);
        $status = OrderStatus::asSelectArray();
        $shippingMethod = ShippingMethod::asSelectArray();

        return view('admin.order.edit', compact('order', 'status', 'shippingMethod'));
    }

    public function invoice($id)
    {
        $order = $this->repository->findOrFail($id);
        return view('admin.order.invoice', compact('order'));
    }

    public function update(OrderUpdateRequest $request)
    {
        $this->service->update($request);
        return redirect()->back()->with('success', 'Cập nhật đơn hàng thành công');
    }

}