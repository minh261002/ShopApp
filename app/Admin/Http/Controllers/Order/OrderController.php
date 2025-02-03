<?php

namespace App\Admin\Http\Controllers\Order;

use App\Admin\DataTables\Order\OrderDataTable;
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
        $paymentStatus = PaymentStatus::asSelectArray();
        $paymentMethod = PaymentMethod::asSelectArray();
        $shippingStatus = ShippingStatus::asSelectArray();
        $shippingMethod = ShippingMethod::asSelectArray();
        return view('admin.order.edit', compact('order', 'status', 'paymentStatus', 'shippingStatus', 'paymentMethod', 'shippingMethod'));
    }

    // public function update(DiscountRequest $request)
    // {
    //     $this->service->update($request);
    //     return redirect()->route('admin.discount.index')->with('success', 'Cập nhật mã giảm giá thành công');
    // }

    public function updateStatus(Request $request)
    {
        $data = $request->only('id', 'status');
        $this->repository->update($data['id'], $data);
        return response()->json(['status' => 'success', 'message' => 'Cập nhật trạng thái thành công']);
    }

}