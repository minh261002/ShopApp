<?php

namespace App\Admin\Http\Requests\Order;

use App\Admin\Http\Requests\BaseRequest;

class OrderUpdateRequest extends BaseRequest
{
    protected function methodPut()
    {
        return [
            'id' => 'required|exists:orders,id',
            'shipping_method' => 'required',
            'status' => 'required',
            'cancel_reason' => 'required_if:status,' . \App\Enums\Order\OrderStatus::Cancelled->value,
        ];
    }
}