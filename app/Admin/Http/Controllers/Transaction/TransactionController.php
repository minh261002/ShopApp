<?php

namespace App\Admin\Http\Controllers\Transaction;

use App\Admin\DataTables\Transaction\TransactionDataTable;
use App\Http\Controllers\Controller;
use App\Repositories\Transaction\TransactionRepositoryInterface;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    protected $repository;

    public function __construct(
        TransactionRepositoryInterface $repository,
    ) {
        $this->repository = $repository;
    }

    public function index(TransactionDataTable $dataTable)
    {
        return $dataTable->render('admin.transaction.index');
    }

    public function edit($id)
    {

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