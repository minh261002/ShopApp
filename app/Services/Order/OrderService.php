<?php

namespace App\Services\Order;

use App\Enums\Order\OrderStatus;
use App\Enums\Order\PaymentMethod;
use App\Enums\Order\PaymentStatus;
use App\Repositories\Order\OrderItemRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\Order\OrderStatusRepositoryInterface;
use App\Repositories\Transaction\TransactionRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Models\DiscountApplication;
use PayOS\PayOS;

class orderService implements OrderServiceInterface
{

    protected $orderRepository;
    protected $orderItemRepository;
    protected $orderStatusRepository;
    protected $transactionRepository;
    private $payOSClientId;
    private $payOSApiKey;
    private $payOSChecksumKey;

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

        $this->payOSClientId = config('services.payos.client_id');
        $this->payOSApiKey = config('services.payos.api_key');
        $this->payOSChecksumKey = config('services.payos.checksum_key');
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $data = $request->validated();

        if (!empty($data['save_profile'])) {
            $user = auth()->guard('web')->user();
            $user->update([
                'name' => $data['order']['name'],
                'email' => $data['order']['email'],
                'phone' => $data['order']['phone'],
                'address' => $data['address'],
                'lat' => $data['lat'],
                'lng' => $data['lng'],
            ]);
        }

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

            $transaction = $this->transactionRepository->create([
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

            $discount_id = $data['discount_id'];

            if ($discount_id) {
                DiscountApplication::withoutTimestamps(function () use ($discount_id, $order) {
                    DiscountApplication::where('discount_id', $discount_id)
                        ->where('user_id', auth()->guard('web')->user()->id)
                        ->whereNull('order_id')
                        ->update(['order_id' => $order->id]);
                });

            }

            DB::commit();

            if ($data['payment_method'] == PaymentMethod::Cash->value) {
                return true;
            } else {
                $checkoutUrl = $this->paymentGateway($transaction);
                return $checkoutUrl;
            }

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error($e->getMessage());
            return false;
        }
    }

    protected function paymentGateway($transaction)
    {
        try {
            $payOS = new PayOS($this->payOSClientId, $this->payOSApiKey, $this->payOSChecksumKey);

            $data = [
                "orderCode" => intval(substr(strval(microtime(true) * 10000), -6)),
                "amount" => intval($transaction->grand_total),
                "description" => "Thanh toán đơn hàng",

                "returnUrl" => route('checkout.result'),
                "cancelUrl" => route('checkout.result'),
            ];

            $response = $payOS->createPaymentLink($data);
            return $response['checkoutUrl'];
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return false;
        }
    }
}