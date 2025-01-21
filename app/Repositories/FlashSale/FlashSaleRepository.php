<?php

namespace App\Repositories\FlashSale;

use App\Models\FlashSale;
use App\Repositories\BaseRepository;

class FlashSaleRepository extends BaseRepository implements FlashSaleRepositoryInterface
{
    public function getModel()
    {
        return FlashSale::class;
    }
}
