<?php

namespace App\Admin\DataTables\Order;

use App\Admin\DataTables\BaseDataTable;
use App\Enums\Order\ShippingMethod;
use App\Enums\Order\ShippingStatus;
use App\Repositories\Order\OrderShippingRepositoryInterface;

class OrderShippingDataTable extends BaseDataTable
{
    protected $nameTable = 'orderShippingTable';
    protected $repository;

    public function __construct(
        OrderShippingRepositoryInterface $repository
    ) {
        $this->repository = $repository;
        parent::__construct();
    }

    public function setView(): void
    {
        $this->view = [
            'action' => 'admin.shipping.datatable.action',
            'shipping_method' => 'admin.shipping.datatable.shipping_method',
            'shipping_status' => 'admin.shipping.datatable.shipping_status',
            'order_id' => 'admin.shipping.datatable.order_id',
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
                'data' => ShippingMethod::asSelectArray()
            ],
            [
                'column' => 5,
                'data' => ShippingStatus::asSelectArray()
            ]
        ];
        $this->columnSearchDate = [];
    }

    protected function setCustomColumns(): void
    {
        $this->customColumns = config('datatable_columns.shippings', []);
    }

    protected function setCustomEditColumns(): void
    {
        $this->customEditColumns = [
            'action' => $this->view['action'],
            'shipping_method' => $this->view['shipping_method'],
            'shipping_status' => $this->view['shipping_status'],
            'order_id' => function ($query) {
                return view($this->view['order_id'], ['order' => $query->order]);
            },
        ];
    }

    protected function setCustomAddColumns(): void
    {
        $this->customAddColumns = [
            'name' => function ($query) {
                return $query->order->name;
            },
            'phone' => function ($query) {
                return $query->order->phone;
            },
        ];
    }

    protected function setCustomRawColumns(): void
    {
        $this->customRawColumns = [
            'action',
            'shipping_method',
            'shipping_status',
        ];
    }

    public function setCustomFilterColumns(): void
    {
        $this->customFilterColumns = [
            'name' => function ($query, $keyword) {
                $query->whereHas('order', function ($query) use ($keyword) {
                    $query->where('name', 'like', '%' . $keyword . '%');
                });
            },
            'phone' => function ($query, $keyword) {
                $query->whereHas('order', function ($query) use ($keyword) {
                    $query->where('phone', 'like', '%' . $keyword . '%');
                });
            },
        ];
    }
}
