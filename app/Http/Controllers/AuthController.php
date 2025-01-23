<?php

namespace App\Http\Controllers;

use App\Enums\ActiveStatus;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('client.auth.login');
    }

    public function handleLogin(LoginRequest $request)
    {
        $data = $request->validated();
        $remember = $data['remember'] ?? false;
        unset($data['remember']);

        if (!auth()->guard('web')->attempt($data, $remember)) {
            notyf()->error('Thông tin đăng nhập không chính xác');
            return back()->withInput($request->only('email'));
        }

        if (auth()->guard('web')->user()->status->value == ActiveStatus::InActive->value) {
            auth()->guard('web')->logout();
            notyf()->error('Tài khoản của bạn hiện không hoạt động');
            return back()->withInput($request->only('email'));
        }

        notyf()->success('Xin chào, ' . auth()->guard('web')->user()->name);
        return redirect()->route('home');
    }

    public function register()
    {
        return view('client.auth.register');
    }

    public function handleRegister(RegisterRequest $request)
    {
        $data = $request->validated();

        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        auth()->guard('web')->login($user);

        notyf()->success('Đăng ký tài khoản thành công');
        return redirect()->route('home');
    }

    public function forgotPassword()
    {
        return view('client.auth.forgot-password');
    }

    public function resetPassword($token, $email)
    {
        return view('client.auth.reset-password', compact('token', 'email'));
    }

    public function logout()
    {
        auth()->guard('web')->logout();
        notyf()->success('Đăng xuất thành công');
        return redirect()->route('home');
    }
}