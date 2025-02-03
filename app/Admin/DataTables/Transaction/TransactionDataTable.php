<?php

namespace App\Admin\DataTables\Transaction;

use App\Admin\DataTables\BaseDataTable;
use App\Enums\Order\PaymentMethod;
use App\Enums\Order\PaymentStatus;
use App\Repositories\Transaction\TransactionRepositoryInterface;

class TransactionDataTable extends BaseDataTable
{
    protected $nameTable = 'transactionTable';
    protected $repository;

    public function __construct(
        TransactionRepositoryInterface $repository
    ) {
        $this->repository = $repository;
        parent::__construct();
    }

    public function setView(): void
    {
        $this->view = [
            'action' => 'admin.transaction.datatable.action',
            'payment_status' => 'admin.transaction.datatable.payment_status',
            'payment_method' => 'admin.transaction.datatable.payment_method',
            'user_id' => 'admin.transaction.datatable.user_id',
            'order_id' => 'admin.transaction.datatable.order_id',
        ];
    }

    public function query()
    {
        return $this->repository->getQueryBuilderOrderBy();
    }

    public function setColumnSearch(): void
    {
        $this->columnAllSearch = [0, 1, 2, 3, 4, 5, 6, 7];
        $this->columnSearchSelect = [
            [
                'column' => 6,
                'data' => PaymentMethod::asSelectArray()
            ],
            [
                'column' => 7,
                'data' => PaymentStatus::asSelectArray()
            ]
        ];
        $this->columnSearchDate = [];
    }

    protected function setCustomColumns(): void
    {
        $this->customColumns = config('datatable_columns.transactions', []);
    }

    protected function setCustomEditColumns(): void
    {
        $this->customEditColumns = [
            'action' => $this->view['action'],
            'created_at' => '{{format_datetime($created_at)}}',
            'payment_method' => $this->view['payment_method'],
            'payment_status' => $this->view['payment_status'],
            'user_id' => function ($query) {
                return view($this->view['user_id'], ['user' => $query->user]);
            },
            'order_id' => function ($query) {
                return view($this->view['order_id'], ['order' => $query->order]);
            },
            'sub_total' => '{{format_price($sub_total)}}',
            'discount_amount' => '{{format_price($discount_amount)}}',
            'shipping_fee' => '{{format_price($shipping_fee)}}',
            'grand_total' => '{{format_price($grand_total)}}',
        ];
    }

    protected function setCustomAddColumns(): void
    {
        $this->customAddColumns = [
        ];
    }

    protected function setCustomRawColumns(): void
    {
        $this->customRawColumns = [
            'action',
            'payment_method',
            'payment_status',
        ];
    }

    public function setCustomFilterColumns(): void
    {
        $this->customFilterColumns = [
            'user_id' => function ($query, $keyword) {
                $query->whereHas('user', function ($query) use ($keyword) {
                    $query->where('name', $keyword);
                });
            },
            'order_id' => function ($query, $keyword) {
                $query->whereHas('order', function ($query) use ($keyword) {
                    $query->where('order_number', $keyword);
                });
            },
        ];
    }
}