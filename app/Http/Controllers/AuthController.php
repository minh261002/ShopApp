<?php

namespace App\Http\Controllers;

use App\Enums\ActiveStatus;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\UserSendResetLinkMail;

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

    public function sendEmailResetLink(ForgotPasswordRequest $request)
    {
        $data = $request->validated();

        $email = $data['email'];
        $device = $data['device'];
        $time = $data['time'];

        $user = User::where('email', $email)->first();

        if (!$user) {
            notyf()->error('Email không tồn tại');
            return back()->withInput($request->only('email'));
        }

        if ($user->status->value == ActiveStatus::InActive->value) {
            notyf()->error('Tài khoản của bạn hiện không hoạt động');
            return back()->withInput($request->only('email'));
        }


        $token = Str::random(60);
        $check = DB::table('password_reset_tokens')->where('email', $email)->first();

        if ($check) {
            DB::table('password_reset_tokens')->where('email', $email)->delete();
            DB::table('password_reset_tokens')->insert([
                'email' => $email,
                'token' => $token,
                'created_at' => now(),
            ]);
        } else {
            DB::table('password_reset_tokens')->insert([
                'email' => $email,
                'token' => $token,
                'created_at' => now(),
            ]);
        }

        Mail::to( $email)->send(new UserSendResetLinkMail($token, $email, $user->name, $device, $time));
        notyf()->success('Vui lòng kiểm tra email để đặt lại mật khẩu');
        return redirect()->back();
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