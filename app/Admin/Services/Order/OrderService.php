<?php

namespace App\Admin\Services\Order;

use App\Admin\Services\Order\OrderServiceInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\Order\OrderStatusRepositoryInterface;
use Illuminate\Http\Request;

class OrderService implements OrderServiceInterface
{
    protected $repository;
    protected $orderStatusRepository;

    public function __construct(
        OrderRepositoryInterface $repository,
        OrderStatusRepositoryInterface $orderStatusRepository
    ) {
        $this->repository = $repository;
        $this->orderStatusRepository = $orderStatusRepository;
    }

    public function update(Request $request)
    {
        $data = $request->validated();

        $orderStatus = $this->orderStatusRepository->findByField('order_id', $data['id'])->first();

        if ($orderStatus && $orderStatus->status != $data['status']) {
            $this->orderStatusRepository->create([
                'order_id' => $data['id'],
                'status' => $data['status'],
                'updated_at' => now(),
            ]);
        }

        unset($data['status']);

        return $this->repository->update($data['id'], $data);
    }
}