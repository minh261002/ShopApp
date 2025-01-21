<?php

namespace App\Admin\DataTables\FlashSale;

use App\Admin\DataTables\BaseDataTable;
use App\Repositories\FlashSale\FlashSaleRepositoryInterface;
use App\Enums\ActiveStatus;

class FlashSaleDataTable extends BaseDataTable
{
    protected $nameTable = 'flashSaleTable';
    protected $repository;

    public function __construct(
        FlashSaleRepositoryInterface $repository
    ) {
        $this->repository = $repository;
        parent::__construct();
    }
    public function setView(): void
    {
        $this->view = [
            'action' => 'admin.flash_sale.datatable.action',
            'status' => 'admin.flash_sale.datatable.status',
            'image' => 'admin.flash_sale.datatable.image',
        ];
    }
    public function query()
    {
        return $this->repository->getQueryBuilderOrderBy();
    }

    public function setColumnSearch(): void
    {

        $this->columnAllSearch = [1, 2, 3, 4];
        $this->columnSearchDate = [2, 3];
        $this->columnSearchSelect = [
            [
                'column' => 4,
                'data' => ActiveStatus::asSelectArray()
            ]
        ];

    }
    protected function setCustomColumns(): void
    {
        $this->customColumns = config('datatable_columns.flashSales', []);
    }

    protected function setCustomEditColumns(): void
    {
        $this->customEditColumns = [
            'action' => $this->view['action'],
            'status' => $this->view['status'],
            'image' => $this->view['image'],
            'start_date' => '{{formatDate($start_date)}}',
            'end_date' => '{{formatDate($end_date)}}',
        ];
    }

    protected function setCustomAddColumns(): void
    {
        $this->customAddColumns = [
            'action' => $this->view['action'],
        ];
    }

    protected function setCustomRawColumns(): void
    {
        $this->customRawColumns = [
            'action',
            'status',
            'image'
        ];
    }

    public function setCustomFilterColumns(): void
    {
        $this->customFilterColumns = [
            //
        ];
    }
}
