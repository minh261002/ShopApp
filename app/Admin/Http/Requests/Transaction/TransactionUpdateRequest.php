<?php

namespace App\Admin\Http\Requests\Transaction;

use App\Admin\Http\Requests\BaseRequest;

class TransactionUpdateRequest extends BaseRequest
{
    protected function methodPut()
    {
        return [
            'id' => 'required|exists:transactions,id',
            'payment_method' => 'required',
            'payment_status' => 'required',
        ];
    }
}