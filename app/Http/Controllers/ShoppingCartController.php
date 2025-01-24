<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShoppingCart\AddToCartRequest;
use App\Repositories\Product\ProductVariationRepositoryInterface;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{

    protected $productVariationRepository;

    public function __construct(ProductVariationRepositoryInterface $productVariationRepository)
    {
        $this->productVariationRepository = $productVariationRepository;
    }

    public function index()
    {
        $cart = session()->get('cart') ?? [];
        $subTotal = 0;
        foreach ($cart as $item) {
            $subTotal += $item['price'] * $item['quantity'];
        }

        $totalPrice = $subTotal;
        return view('client.shopping-cart.index', compact('cart', 'subTotal', 'totalPrice'));
    }

    public function store(AddToCartRequest $request)
    {
        $data = $request->validated();

        $cart = session()->get('cart', []);

        if (isset($cart[$data['product_variation_id']])) {
            $cart[$data['product_variation_id']]['quantity'] += $data['quantity'];
        } else {
            $cart[$data['product_variation_id']] = [
                'product_variation_id' => $data['product_variation_id'],
                'product_name' => $data['product_name'],
                'product_image' => $data['product_image'],
                'product_slug' => $data['product_slug'],
                'quantity' => $data['quantity'],
                'price' => $data['price'],
                'variation_values' => $data['variation_values'],
            ];
        }

        $productVariation = $this->productVariationRepository->findOrFail($data['product_variation_id']);
        if ($productVariation->stock < $cart[$data['product_variation_id']]['quantity']) {
            return redirect()->back()->with('error', 'Số lượng sản phẩm trong kho không đủ');
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng');
    }


    public function updateQuantity(Request $request)
    {
        $cart = session()->get('cart') ?? [];

        $productVariationId = $request->product_variation_id;
        $quantity = $request->quantity;

        $productVariation = $this->productVariationRepository->findOrFail($productVariationId);

        if ($productVariation->stock < $quantity) {
            return response()->json([
                'message' => 'Số lượng sản phẩm trong kho không đủ',
            ], 400);
        }

        foreach ($cart as $key => $value) {
            if ($value['product_variation_id'] == $productVariationId) {
                $cart[$key]['quantity'] = $quantity;
            }
        }

        session()->put('cart', $cart);

        return response()->json([
            'message' => 'Cập nhật số lượng sản phẩm thành công',
        ]);
    }

    public function destroy($variation_id)
    {
        $cart = session()->get('cart') ?? [];

        foreach ($cart as $key => $value) {
            if ($value['product_variation_id'] == $variation_id) {
                unset($cart[$key]);
            }
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Xóa sản phẩm khỏi giỏ hàng thành công');
    }
}