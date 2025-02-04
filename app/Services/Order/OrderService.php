<?php

namespace App\Services\Order;

use App\Enums\Order\PaymentStatus;
use App\Enums\Order\ShippingStatus;
use App\Repositories\Order\OrderItemRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\Order\OrderShippingRepositoryInterface;
use App\Repositories\Transaction\TransactionRepositoryInterface;
use Illuminate\Support\Facades\DB;

class orderService implements OrderServiceInterface
{
    protected $orderRepository;
    protected $orderItemRepository;
    protected $orderShippingRepository;
    protected $transactionRepository;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        OrderItemRepositoryInterface $orderItemRepository,
        OrderShippingRepositoryInterface $orderShippingRepository,
        TransactionRepositoryInterface $transactionRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->orderItemRepository = $orderItemRepository;
        $this->orderShippingRepository = $orderShippingRepository;
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

            $this->orderShippingRepository->create([
                'order_id' => $order->id,
                'shipping_method' => $data['shipping_method'],
                'shipping_status' => ShippingStatus::Pending->value,
                'tracking_number' => 'N.A',
            ]);

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

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}
