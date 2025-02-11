<?php

namespace App\Http\Requests\Checkout;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'order.user_id' => 'required|exists:users,id',
            'cart' => 'required',
            'sub_total' => 'required',
            'total_price' => 'required',
            'discount_amount' => 'nullable',
            'shipping_fee' => 'nullable',
            'order.name' => 'required',
            'order.email' => 'required|email',
            'order.phone' => 'required',
            'address' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'payment_method' => 'required',
            'shipping_method' => 'required',
            'order.note' => 'nullable',
            'discount_id' => 'nullable'
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'Id không được để trống',
            'user_id.exists' => 'Id không tồn tại',
            'cart.required' => 'Giỏ hàng không được để trống',
            'cart.array' => 'Giỏ hàng phải là một mảng',
            'cart.*.product_variation_id.required' => 'Id sản phẩm không được để trống',
            'cart.*.product_variation_id.exists' => 'Id sản phẩm không tồn tại',
            'sub_total.required' => 'Tổng tiền không được để trống',
            'total_price.required' => 'Tổng tiền không được để trống',
            'name.required' => 'Tên không được để trống',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'phone.required' => 'Số điện thoại không được để trống',
            'address.required' => 'Địa chỉ không được để trống',
            'payment_method.required' => 'Phương thức thanh toán không được để trống',
            'shipping_method.required' => 'Phương thức vận chuyển không được để trống',
        ];
    }
}