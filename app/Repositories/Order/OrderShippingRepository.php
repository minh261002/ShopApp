<?php

namespace App\Repositories\Order;

use App\Repositories\BaseRepository;
use App\Models\OrderShipping;

class OrderShippingRepository extends BaseRepository implements OrderShippingRepositoryInterface
{
    public function getModel()
    {
        return OrderShipping::class;
    }
}