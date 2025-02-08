<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'image' => 'nullable|image',
            'old_image' => 'nullable',
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . auth()->guard('web')->id(),
            'phone' => 'required|unique:users,phone,' . auth()->guard('web')->id(),
            'address' => 'nullable',
            'lat' => 'nullable',
            'lng' => 'nullable',
            'birthday' => 'nullable',
            'description' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên không được để trống',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'phone.required' => 'Số điện thoại không được để trống',
            'address.required' => 'Địa chỉ không được để trống',
        ];
    }
}