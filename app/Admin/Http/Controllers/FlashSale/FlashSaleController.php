<?php
namespace App\Admin\Http\Controllers\FlashSale;

use App\Admin\Services\FlashSale\FlashSaleServiceInterface;
use App\Http\Controllers\Controller;
use App\Repositories\FlashSale\FlashSaleItemRepositoryInterface;
use App\Repositories\FlashSale\FlashSaleRepositoryInterface;

class FlashSaleController extends Controller
{
    protected $repository;
    protected $itemRepository;
    protected $service;

    public function __construct(
        FlashSaleRepositoryInterface $repository,
        FlashSaleItemRepositoryInterface $itemRepository,
        FlashSaleServiceInterface $service
    ) {
        $this->repository = $repository;
        $this->itemRepository = $itemRepository;
        $this->service = $service;
    }
}