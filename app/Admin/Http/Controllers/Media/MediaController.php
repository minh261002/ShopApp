<?php

namespace App\Admin\Http\Controllers\Media;

use App\Admin\Http\Requests\Media\DeleteFileRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index()
    {
        $directory = public_path('uploads/images');
        $directories = File::directories($directory);

        return view('admin.media.index', compact('directories'));
    }

    public function getMedia($folder)
    {
        $directory = public_path('uploads/images/' . $folder);
        $files = File::files($directory);

        return view('admin.media.get', compact('files', 'folder'));
    }

    public function delete(DeleteFileRequest $request)
    {
        $data = $request->validated();

        foreach ($data['files'] as $file) {
            $path = parse_url($file, PHP_URL_PATH);
            $path = public_path($path);
            File::delete($path);
        }

        return redirect()->back()->with('success', 'Xoá các tệp đã chọn thành công');
    }
}