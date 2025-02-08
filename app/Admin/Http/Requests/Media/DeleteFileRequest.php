<?php

namespace App\Admin\Http\Requests\Media;

use Illuminate\Foundation\Http\FormRequest;

class DeleteFileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'folder' => 'required',
            'files' => 'required|array',
        ];
    }
}