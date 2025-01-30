<?php

namespace App\Admin\Http\Controllers\Order;

use App\Admin\DataTables\Order\OrderDataTable;
use App\Admin\Services\Order\OrderServiceInterface;
use App\Enums\ActiveStatus;
use App\Http\Controllers\Controller;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $repository;
    protected $service;
    protected $userRepository;
    public function __construct(
        OrderRepositoryInterface $repository,
        UserRepositoryInterface $userRepository,
        OrderServiceInterface $service
    ) {
        $this->repository = $repository;
        $this->service = $service;
        $this->userRepository = $userRepository;
    }

    public function index(OrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.index');
    }

    public function edit($id)
    {
        $discount = $this->repository->find($id);
        $status = ActiveStatus::asSelectArray();
        $types = DiscountType::asSelectArray();
        $applyFor = DiscountApplyFor::asSelectArray();
        $member = $this->userRepository->getByQueryBuilder(
            ['status' => ActiveStatus::Active->value],
        )->get();
        return view('admin.discount.edit', compact('discount', 'status', 'types', 'applyFor', 'member'));
    }

    public function update(DiscountRequest $request)
    {
        $this->service->update($request);
        return redirect()->route('admin.discount.index')->with('success', 'Cập nhật mã giảm giá thành công');
    }

    public function updateStatus(Request $request)
    {
        $data = $request->only('id', 'status');
        $this->repository->update($data['id'], $data);
        return response()->json(['status' => 'success', 'message' => 'Cập nhật trạng thái thành công']);
    }

}