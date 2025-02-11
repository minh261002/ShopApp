<?php

namespace App\Admin\Http\Controllers\Transaction;

use App\Admin\DataTables\Transaction\TransactionDataTable;
use App\Admin\Http\Requests\Transaction\TransactionUpdateRequest;
use App\Admin\Services\Transaction\TransactionServiceInterface;
use App\Enums\Order\PaymentMethod;
use App\Enums\Order\PaymentStatus;
use App\Http\Controllers\Controller;
use App\Repositories\Transaction\TransactionRepositoryInterface;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    protected $repository;
    protected $service;

    public function __construct(
        TransactionRepositoryInterface $repository,
        TransactionServiceInterface $service
    ) {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index(TransactionDataTable $dataTable)
    {
        return $dataTable->render('admin.transaction.index');
    }

    public function edit($id)
    {
        $transaction = $this->repository->findOrFail($id);
        $paymentMethod = PaymentMethod::asSelectArray();
        $paymentStatus = PaymentStatus::asSelectArray();
        return view('admin.transaction.edit', compact('transaction', 'paymentMethod', 'paymentStatus'));
    }

    public function update(TransactionUpdateRequest $request)
    {
        $this->service->update($request);
        return redirect()->back()->with('success', 'Cập nhật giao dịch thành công');
    }

}