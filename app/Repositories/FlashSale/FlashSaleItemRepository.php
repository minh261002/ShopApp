<?php

namespace App\Repositories\FlashSale;

use App\Models\FlashSaleItem;
use App\Repositories\BaseRepository;

class FlashSaleItemRepository extends BaseRepository implements FlashSaleItemRepositoryInterface
{
    public function getModel()
    {
        return FlashSaleItem::class;
    }

    public function deleteBySaleId($saleId)
    {
        return $this->model->where('flash_sale_id', $saleId)->delete();
    }
}
