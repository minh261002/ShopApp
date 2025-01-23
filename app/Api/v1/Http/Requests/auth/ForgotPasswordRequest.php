<?php

namespace App\Api\V1\Http\Requests\Auth;

use App\Admin\Http\Requests\BaseRequest;

class ForgotPasswordRequest extends BaseRequest
{
    protected function methodPost()
    {
        return [
            'email' => 'required|email|exists:users,email',
            'time' => 'required',
            'device' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.exists' => 'Email không tồn tại',
        ];
    }
}
