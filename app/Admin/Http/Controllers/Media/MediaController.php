<?php

namespace App\Admin\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

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
}