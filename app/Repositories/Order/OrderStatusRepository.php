<?php

namespace App\Repositories\Order;

use App\Repositories\BaseRepository;
use App\Models\OrderStatus;

class OrderStatusRepository extends BaseRepository implements OrderStatusRepositoryInterface
{
    public function getModel()
    {
        return OrderStatus::class;
    }
}