<?php

namespace App\Http\Controllers;

use App\Enums\Order\PaymentMethod;
use App\Enums\Order\ShippingMethod;
use App\Http\Requests\Checkout\CheckoutRequest;
use App\Models\Province;
use App\Repositories\Order\OrderItemRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Services\Order\OrderServiceInterface;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    protected $orderRepository;
    protected $orderItemRepository;
    protected $service;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        OrderItemRepositoryInterface $orderItemRepository,
        OrderServiceInterface $service
    ) {
        $this->orderRepository = $orderRepository;
        $this->orderItemRepository = $orderItemRepository;
        $this->service = $service;
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

    public function store(CheckoutRequest $request){
       $response =  $this->service->store($request);
       if($response){
        session()->forget('cart');
        return redirect()->route('home')->with('success', 'Đặt hàng thành công');
       }else{
        return redirect()->back()->with('error', 'Đặt hàng thất bại');
       }
    }
}