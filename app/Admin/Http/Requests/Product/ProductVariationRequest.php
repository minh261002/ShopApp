<?php

namespace App\Admin\Http\Requests\Product;

use App\Admin\Http\Requests\BaseRequest;

class ProductVariationRequest extends BaseRequest
{
    public function methodPost()
    {
        return [
            'product_id' => 'required|exists:products,id',
            'attributes' => 'required|array',
            'price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'stock' => 'required|numeric',
            'sku' => 'required',
        ];
    }

    public function methodPut()
    {
        return [
            'id' => 'required|exists:product_variations,id',
            'product_id' => 'required|exists:products,id',
            'attributes' => 'required|array',
            'price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'stock' => 'required|numeric',
            'sku' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'product_id.required' => 'Vui lòng chọn sản phẩm',
            'product_id.exists' => 'Sản phẩm không tồn tại',
            'attributes.required' => 'Vui lòng chọn thuộc tính',
            'attributes.array' => 'Thuộc tính không hợp lệ',
            'price.required' => 'Vui lòng nhập giá',
            'price.numeric' => 'Giá không hợp lệ',
            'sale_price.numeric' => 'Giá khuyến mãi không hợp lệ',
            'stock.required' => 'Vui lòng nhập số lượng',
            'stock.numeric' => 'Số lượng không hợp lệ',
            'sku.required' => 'Vui lòng nhập mã sản phẩm',
        ];
    }
}