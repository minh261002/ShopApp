<?php

namespace App\Repositories\FlashSale;

use App\Repositories\BaseRepositoryInterface;

interface FlashSaleItemRepositoryInterface extends BaseRepositoryInterface
{
    public function deleteBySaleId($saleId);
}
