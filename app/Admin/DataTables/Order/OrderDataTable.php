<?php

namespace App\Admin\DataTables\Order;

use App\Admin\DataTables\BaseDataTable;
use App\Enums\Order\OrderStatus;
use App\Enums\Order\PaymentStatus;
use App\Repositories\Order\OrderRepositoryInterface;

class OrderDataTable extends BaseDataTable
{
    protected $nameTable = 'orderTable';
    protected $repository;

    public function __construct(
        OrderRepositoryInterface $repository
    ) {
        $this->repository = $repository;
        parent::__construct();
    }

    public function setView(): void
    {
        $this->view = [
            'action' => 'admin.order.datatable.action',
            'status' => 'admin.order.datatable.status',
            'payment_status' => 'admin.order.datatable.payment_status',
        ];
    }

    public function query()
    {
        return $this->repository->getQueryBuilderOrderBy();
    }

    public function setColumnSearch(): void
    {
        $this->columnAllSearch = [0, 1, 2, 3, 4, 5];
        $this->columnSearchSelect = [
            [
                'column' => 3,
                'data' => PaymentStatus::asSelectArray()
            ],
            [
                'column' => 4,
                'data' => OrderStatus::asSelectArray()
            ]
        ];
        $this->columnSearchDate = [5];
    }

    protected function setCustomColumns(): void
    {
        $this->customColumns = config('datatable_columns.orders', []);
    }

    protected function setCustomEditColumns(): void
    {
        $this->customEditColumns = [
            'action' => $this->view['action'],
            'created_at' => '{{format_datetime($created_at)}}',
            'status' => function ($query) {
                return view($this->view['status'], ['status' => $query->status->last()->status]);
            },
        ];
    }

    protected function setCustomAddColumns(): void
    {
        $this->customAddColumns = [
            'amount' => function ($query) {
                return format_price($query->transaction->grand_total);
            },
            'pạyment_status' => function ($query) {
                return view($this->view['payment_status'], ['payment_status' => $query->transaction->payment_status]);
            },
        ];
    }

    protected function setCustomRawColumns(): void
    {
        $this->customRawColumns = [
            'action',
            'status',
            'payment_status',
        ];
    }

    public function setCustomFilterColumns(): void
    {
        $this->customFilterColumns = [
            'amount' => function ($query, $keyword) {
                $query->whereHas('transaction', function ($query) use ($keyword) {
                    $query->where('grand_total', $keyword);
                });
            },
        ];
    }
}