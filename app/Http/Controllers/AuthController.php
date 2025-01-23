<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
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
            return back()->withInput($request->only('email'))->with('error', 'Thông tin đăng nhập không chính xác');
        }

        notyf()->success('Xin chào, ' . auth()->guard('web')->user()->name);
        return redirect()->route('home');
    }

    public function register()
    {
        return view('client.auth.register');
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