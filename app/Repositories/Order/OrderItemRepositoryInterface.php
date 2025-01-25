<?php

namespace App\Repositories\Order;

use App\Repositories\BaseRepositoryInterface;

interface OrderItemRepositoryInterface extends BaseRepositoryInterface
{
    public function insert($data);
}