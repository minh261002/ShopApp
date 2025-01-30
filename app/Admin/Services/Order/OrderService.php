<?php

namespace App\Admin\Services\Order;

use App\Admin\Services\Order\OrderServiceInterface;
use App\Models\Order;
use App\Repositories\BaseRepository;

class OrderService extends BaseRepository implements OrderServiceInterface
{
    public function getModel()
    {
        return Order::class;
    }
}