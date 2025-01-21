<?php

namespace App\Admin\Services\FlashSale;

use App\Repositories\FlashSale\FlashSaleItemRepositoryInterface;
use App\Repositories\FlashSale\FlashSaleRepositoryInterface;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        $data = $request->validated();
        $saleData = $data['sale'];
        $itemsData = $data['item'];

        if ($saleData['image'] == null) {
            $saleData['image'] = '/admin/images/not-found.jpg';
        }
        $sale = $this->repository->create($saleData);
        foreach ($itemsData['product_id'] as $key => $productId) {
            $item = [
                'flash_sale_id' => $sale->id,
                'product_id' => $productId,
                'discount' => $itemsData['discount']
            ];
            $this->itemRepository->create($item);
        }

        return $sale;
    }

    public function update(Request $request)
    {
        $data = $request->validated();
        $saleData = $data['sale'];
        $itemsData = $data['item'];

        if ($saleData['image'] == null) {
            $saleData['image'] = '/admin/images/not-found.jpg';
        }

        $sale = $this->repository->update($saleData['id'], $saleData);

        $this->itemRepository->deleteBySaleId($sale->id);
        foreach ($itemsData['product_id'] as $key => $productId) {
            $item = [
                'flash_sale_id' => $sale->id,
                'product_id' => $productId,
                'discount' => $itemsData['discount']
            ];
            $this->itemRepository->create($item);
        }

        return $sale;
    }
}