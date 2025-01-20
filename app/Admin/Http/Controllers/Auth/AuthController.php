<?php

namespace App\Admin\Http\Controllers\Auth;

use App\Admin\Http\Requests\Auth\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;


class AuthController extends Controller
{
    public function login(): View
    {
        return view('admin.auth.login');
    }

    public function handleLogin(LoginRequest $request)
    {

        $data = $request->validated();

        $email = $data['email'];
        $password = $data['password'];

        if (auth()->guard('admin')->attempt(['email' => $email, 'password' => $password])) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')->with('success', 'Xin chào, ' . auth()->guard('admin')->user()->name);
        }

        return redirect()->back()->withInput()->with('error', 'Thông tin đăng nhập không chính xác');
    }

    public function logout()
    {
        auth()->guard('admin')->logout();
        return redirect()->route('admin.login')->with('success', 'Đăng xuất thành công');
    }

    public function forgotPassword(): View
    {
        return view('admin.auth.forgot-password');
    }

    public function resetPassword(): View
    {
        return view('admin.auth.reset-password');
    }
}
