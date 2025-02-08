<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\UpdatePasswordRequest;
use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Services\Profile\ProfileServiceInterface;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    protected $service;

    public function __construct(
        ProfileServiceInterface $service
    ) {
        $this->service = $service;
    }

    public function index()
    {
        $user = auth()->guard('web')->user();
        return view('client.profile.index', compact('user'));
    }

    public function update(UpdateProfileRequest $request)
    {
        if ($this->service->updateProfile($request)) {
            return redirect()->back()->with('success', 'Cập nhật thông tin cá nhân thành công');
        } else {
            return redirect()->back()->with('error', 'Đã có lỗi xảy ra');
        }
    }

    public function changePassword()
    {
        return view('client.profile.change-password');
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        if ($this->service->updatePassword($request)) {
            return redirect()->back()->with('success', 'Cập nhật mật khẩu thành công');
        } else {
            return redirect()->back()->with('error', 'Đã có lỗi xảy ra');
        }
    }


}