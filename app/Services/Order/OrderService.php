<?php

namespace App\Services\Order;

use App\Enums\Order\OrderStatus;
use App\Enums\Order\PaymentStatus;
use App\Repositories\Order\OrderItemRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\Order\OrderStatusRepositoryInterface;
use App\Repositories\Transaction\TransactionRepositoryInterface;
use Illuminate\Support\Facades\DB;

class orderService implements OrderServiceInterface
{
    protected $orderRepository;
    protected $orderItemRepository;
    protected $orderStatusRepository;
    protected $transactionRepository;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        OrderItemRepositoryInterface $orderItemRepository,
        TransactionRepositoryInterface $transactionRepository,
        OrderStatusRepositoryInterface $orderStatusRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->orderItemRepository = $orderItemRepository;
        $this->orderStatusRepository = $orderStatusRepository;
        $this->transactionRepository = $transactionRepository;
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $data = $request->validated();

        DB::beginTransaction();

        try {
            $orderData = $data['order'];
            $orderData['address'] = $data['address'];
            $orderData['lat'] = $data['lat'];
            $orderData['lng'] = $data['lng'];
            $orderData['order_number'] = 'DH' . rand(100000000, 999999999);
            $orderData['shipping_method'] = $data['shipping_method'];
            $order = $this->orderRepository->create($orderData);

            $cart = json_decode($data['cart']);

            $orderItemDatas = [];
            foreach ($cart as $item) {
                $orderItemDatas[] = [
                    'order_id' => $order->id,
                    'product_variation_id' => $item->product_variation_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ];
            }

            $this->orderItemRepository->insert($orderItemDatas);

            $this->transactionRepository->create([
                'user_id' => $order->user_id,
                'order_id' => $order->id,
                'sub_total' => $data['sub_total'],
                'discount_amount' => $data['discount_amount'],
                'shipping_fee' => $data['shipping_fee'],
                'grand_total' => $data['total_price'],
                'payment_method' => $data['payment_method'],
                'payment_status' => PaymentStatus::Pending->value,
            ]);

            $this->orderStatusRepository->create([
                'order_id' => $order->id,
                'status' => OrderStatus::Pending->value,
                'updated_at' => now(),
            ]);

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}