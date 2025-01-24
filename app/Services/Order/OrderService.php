<?php

namespace App\Services\Order;

use App\Repositories\Order\OrderItemRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\Order\OrderShippingRepositoryInterface;

class orderService implements OrderServiceInterface
{
    protected $orderRepository;
    protected $orderItemRepository;
    protected $orderShippingRepository;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        OrderItemRepositoryInterface $orderItemRepository,
        OrderShippingRepositoryInterface $orderShippingRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->orderItemRepository = $orderItemRepository;
        $this->orderShippingRepository = $orderShippingRepository;
    }
}