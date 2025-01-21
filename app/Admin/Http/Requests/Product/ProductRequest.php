<?php

namespace App\Admin\Http\Requests\Product;

use App\Admin\Http\Requests\BaseRequest;

class ProductRequest extends BaseRequest
{
    public function methodPost()
    {
        return [
            "name" => "required",
            "short_desc" => "nullable",
            "desc" => "nullable",
            "gallery" => "nullable",
            "image" => "nullable",
            "category_id" => "required|array",
            "category_id.*" => "required|exists:categories,id",
            "status" => "required",
            'meta_title' => 'nullable',
            'meta_description' => 'nullable',
            'meta_keywords' => 'nullable',
        ];
    }

    public function methodPut()
    {
        return [
            "id" => "required|exists:products,id",
            "name" => "required",
            "short_desc" => "nullable",
            "desc" => "nullable",
            "gallery" => "nullable",
            "image" => "nullable",
            "category_id" => "required|array",
            "category_id.*" => "required|exists:categories,id",
            "status" => "required",
            'meta_title' => 'nullable',
            'meta_description' => 'nullable',
            'meta_keywords' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "Tên sản phẩm không được để trống",
            "category_id.required" => "Danh mục không được để trống",
            "category_id.*.required" => "Danh mục không được để trống",
            "category_id.*.exists" => "Danh mục không tồn tại",
            "status.required" => "Trạng thái không được để trống",
        ];
    }
}