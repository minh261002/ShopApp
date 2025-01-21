<?php

namespace App\Admin\Services\FlashSale;

use App\Repositories\FlashSale\FlashSaleItemRepositoryInterface;
use App\Repositories\FlashSale\FlashSaleRepositoryInterface;


class FlashSaleService implements FlashSaleServiceInterface
{
    protected $repository;
    protected $itemRepository;

    public function __construct(
        FlashSaleRepositoryInterface $repository,
        FlashSaleItemRepositoryInterface $itemRepository
    ) {
        $this->repository = $repository;
        $this->itemRepository = $itemRepository;
    }
}
