<?php

namespace App\Admin\Http\Controllers\Shipping;

use App\Admin\DataTables\Order\OrderShippingDataTable;
use App\Enums\Order\PaymentMethod;
use App\Enums\Order\PaymentStatus;
use App\Http\Controllers\Controller;
use App\Repositories\Order\OrderShippingRepositoryInterface;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    protected $repository;

    public function __construct(
        OrderShippingRepositoryInterface $repository,
    ) {
        $this->repository = $repository;
    }

    public function index(OrderShippingDataTable $dataTable)
    {
        return $dataTable->render('admin.shipping.index');
    }

    public function edit($id)
    {
        $transaction = $this->repository->findOrFail($id);
        $paymentMethod = PaymentMethod::asSelectArray();
        $paymentStatus = PaymentStatus::asSelectArray();
        return view('admin.transaction.edit', compact('transaction', 'paymentMethod', 'paymentStatus'));
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