<?php

namespace App\Admin\Http\Requests\FlashSale;

use App\Admin\Http\Requests\BaseRequest;

class FlashSaleRequest extends BaseRequest
{
    public function methodPost()
    {
        return [
            'sale.title' => 'required',
            'sale.start_date' => 'required',
            'sale.end_date' => 'required|after:sale.date_start',
            'sale.status' => 'required',
            'sale.image' => 'nullable',
            'item' => 'required|array',
            'item.product_id' => 'required|array',
            'item.product_id.*' => 'required|exists:products,id',
            'item.discount' => 'required',
        ];
    }

    public function methodPut()
    {
        return [
            'sale.id' => 'required|exists:flash_sales,id',
            'sale.title' => 'required',
            'sale.start_date' => 'required',
            'sale.end_date' => 'required|after:sale.date_start',
            'sale.status' => 'required',
            'sale.image' => 'nullable',
            'item' => 'required|array',
            'item.product_id' => 'required|array',
            'item.product_id.*' => 'required|exists:products,id',
            'item.discount' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'sale.title.required' => 'Nhập tiêu đề',
            'sale.start_date.required' => 'Chọn ngày bắt đầu',
            'sale.end_date.required' => 'Chọn ngày kết thúc',
            'sale.end_date.after' => 'Ngày kết thúc phải sau ngày bắt đầu',
            'sale.status.required' => 'Chọn trạng thái',
            'item.required' => 'Chọn sản phẩm',
            'item.array' => 'Chọn sản phẩm',
            'item.product_id.required' => 'Chọn sản phẩm',
            'item.product_id.array' => 'Chọn sản phẩm',
            'item.product_id.*.required' => 'Chọn sản phẩm',
            'item.product_id.*.exists' => 'Sản phẩm không tồn tại',
            'item.discount.required' => 'Nhập giảm giá',
        ];
    }
}
