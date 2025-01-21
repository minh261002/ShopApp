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
}