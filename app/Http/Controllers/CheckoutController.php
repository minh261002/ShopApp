<?php

namespace App\Http\Controllers;

use App\Enums\Order\PaymentMethod;
use App\Enums\Order\ShippingMethod;
use App\Models\Province;
use App\Repositories\Order\OrderItemRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    protected $orderRepository;
    protected $orderItemRepository;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        OrderItemRepositoryInterface $orderItemRepository,
    ) {
        $this->orderRepository = $orderRepository;
        $this->orderItemRepository = $orderItemRepository;
    }

    public function index()
    {
        $cart = session()->get('cart');
        $subTotal = 0;
        foreach ($cart as $item) {
            $subTotal += $item['price'] * $item['quantity'];
        }
        $totalPrice = $subTotal;
        $provinces = Province::all();
        $payment_methods = PaymentMethod::asSelectArray();
        $shipping_methods = ShippingMethod::asSelectArray();

        return view('client.checkout.index', compact('cart', 'subTotal', 'totalPrice', 'provinces', 'payment_methods', 'shipping_methods'));
    }
}