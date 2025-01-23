<?php

namespace App\Admin\DataTables\Product;

use App\Admin\DataTables\BaseDataTable;
use App\Enums\ActiveStatus;
use App\Repositories\Product\ProductVariationRepositoryInterface;

class ProductVariationDataTable extends BaseDataTable
{
    protected $nameTable = 'productVariationTable';
    protected $repository;

    public function __construct(
        ProductVariationRepositoryInterface $repository
    ) {
        $this->repository = $repository;
        parent::__construct();
    }

    public function setView(): void
    {
        $this->view = [
            'action' => 'admin.product.variation.datatable.action',
        ];
    }

    public function query()
    {
        return $this->repository->getByQueryBuilder([
            'product_id' => request()->route('id'),
        ]);
    }

    public function setColumnSearch(): void
    {
        $this->columnAllSearch = [0, 1, 2, 3];
        $this->columnSearchSelect = [
            //
        ];
    }

    protected function setCustomColumns(): void
    {
        $this->customColumns = config('datatable_columns.productVariations', []);
    }

    protected function setCustomEditColumns(): void
    {
        $this->customEditColumns = [
            'action' => $this->view['action'],
            'created_at' => '{{format_datetime($created_at)}}',
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
        ];
    }

    public function setCustomFilterColumns(): void
    {
        $this->customFilterColumns = [

        ];
    }
}