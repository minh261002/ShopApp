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

    public function store(AddToCartRequest $request)
    {
        $data = $request->validated();


        $cart = session()->get('cart') ?? [];

        $cart[$data['product_variation_id']] = [
            'product_variation_id' => $data['product_variation_id'],
            'quantity' => $data['quantity'],
            'price' => $data['price'],
            'variation_values' => $data['variation_values'],
        ];

        $productVariation = $this->productVariationRepository->findOrFail($data['product_variation_id']);

        if ($productVariation->stock < $data['quantity']) {
            return redirect()->back()->with('error', 'Số lượng sản phẩm trong kho không đủ');
        }

        foreach ($cart as $key => $value) {
            if ($value['product_variation_id'] == $data['product_variation_id']) {
                $cart[$key]['quantity'] += $data['quantity'];
            }
        }



        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng');
    }
}