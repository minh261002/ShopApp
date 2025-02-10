<?php

namespace App\Http\Controllers;

use App\Enums\Discount\DiscountType;
use Illuminate\Http\Request;
use App\Models\Discount;

class DiscountController extends Controller
{
    public function applyVoucher(Request $request)
    {
        $voucher = $request->voucher;

        $cart = session('cart') ?? [];

        $total = array_reduce($cart, function ($carry, $item) {
            return $carry + $item['quantity'] * ($item['sale_price'] ?? $item['price']);
        }, 0);

        $discount = Discount::where('code', $voucher)->active()->first();
        if (!$discount) {
            return response()->json([
                'message' => 'Mã giảm giá không tồn tại',
                'status' => 404
            ]);
        }

        if ($discount->users->isNotEmpty() && !$discount->users->contains(Auth()->guard('web')->id())) {
            return response()->json([
                'message' => 'Bạn không có quyền sử dụng mã giảm giá này',
                'status' => 403
            ]);
        }

        if ($discount->orders->isNotEmpty()) {
            return response()->json([
                'message' => 'Mã giảm giá đã được sử dụng',
                'status' => 403
            ]);
        }

        if ($total < $discount->min_order_amount) {
            return response()->json([
                'message' => 'Đơn hàng của bạn chưa đạt giá trị tối thiểu để sử dụng mã giảm giá',
                'status' => 403
            ]);
        }

        if ($discount->type == DiscountType::Fixed) {
            $amount = $discount->discount_value;
        } else {
            $amount = $total * $discount->percent_value / 100;
        }

        $total -= $amount;

        session()->put('voucher', $discount);
        session()->put('discount', $amount);

        return response()->json([
            'message' => 'Áp dụng mã giảm giá thành công',
            'discount' => $amount,
            'total' => $total,
            'status' => 200
        ]);
    }

    public function removeVoucher()
    {
        session()->forget(['voucher', 'discount']);
        return redirect()->back();
    }
}