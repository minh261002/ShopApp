<?php

namespace App\Http\Requests\ShoppingCart;

use Illuminate\Foundation\Http\FormRequest;

class AddToCartRequest extends FormRequest
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
            'product_variation_id' => ['required', 'exists:product_variations,id'],
            'product_name' => ['required', 'string'],
            'product_image' => ['required', 'string'],
            'product_slug' => ['required', 'string'],
            'quantity' => ['required', 'integer', 'min:1'],
            'price' => ['required', 'numeric', 'min:0'],
            'variation_values' => ['required', 'array'],
            'variation_values.*' => ['required', 'exists:product_variations_values,value'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'product_id.exists' => 'Sản phẩm không tồn tại',
            'product_variation_id.required' => 'Chọn biến thể sản phẩm',
            'product_variation_id.exists' => 'Biến thể sản phẩm không tồn tại',
            'quantity.required' => 'Nhập số lượng sản phẩm',
            'quantity.integer' => 'Số lượng sản phẩm phải là số nguyên',
            'quantity.min' => 'Số lượng sản phẩm phải lớn hơn 0',
            'price.required' => 'Nhập giá sản phẩm',
            'price.numeric' => 'Giá sản phẩm phải là số',
            'price.min' => 'Giá sản phẩm phải lớn hơn hoặc bằng 0',
            'variation_values.required' => 'Chọn giá trị biến thể sản phẩm',
            'variation_values.array' => 'Giá trị biến thể sản phẩm phải là mảng',
            'variation_values.*.required' => 'Chọn giá trị biến thể sản phẩm',
            'variation_values.*.exists' => 'Giá trị biến thể sản phẩm không tồn tại',
        ];
    }
}