<?php

namespace App\Admin\DataTables\Post;

use App\Admin\DataTables\BaseDataTable;
use App\Repositories\Post\PostCatalogueRepositoryInterface;
use App\Enums\ActiveStatus;

class PostCatalogueDataTable extends BaseDataTable
{
    protected $nameTable = 'postCatalogueTable';
    protected $repository;

    public function __construct(
        PostCatalogueRepositoryInterface $repository
    ) {
        $this->repository = $repository;
        parent::__construct();
    }
    public function setView(): void
    {
        $this->view = [
            'action' => 'admin.post-catalogue.datatable.action',
            'image' => 'admin.post-catalogue.datatable.image',
            'status' => 'admin.post-catalogue.datatable.status',
            'show_menu' => 'admin.post-catalogue.datatable.show_menu',
        ];
    }
    public function query()
    {
        return $this->repository->getFlatTreeBuilder();
    }

    public function setColumnSearch(): void
    {

        $this->columnAllSearch = [1, 2, 3, 4];
        $this->columnSearchSelect = [
            [
                'column' => 4,
                'data' => ActiveStatus::asSelectArray(),
            ],
            [
                'column' => 3,
                'data' => [
                    '0' => 'Không hiển thị',
                    '1' => 'Hiển thị',
                ]
            ]
        ];

    }
    protected function setCustomColumns(): void
    {
        $this->customColumns = config('datatable_columns.post_catalogues', []);
    }

    protected function setCustomEditColumns(): void
    {
        $this->customEditColumns = [
            'action' => $this->view['action'],
            'image' => $this->view['image'],
            'status' => $this->view['status'],
            'name' => function ($query) {
                return generate_text_depth_tree($query->depth) . $query->name;
            },
            'show_menu' => $this->view['show_menu'],
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
            'image',
            'status',
            'show_menu',
        ];
    }

    public function setCustomFilterColumns(): void
    {
        $this->customFilterColumns = [
            //
        ];
    }
}