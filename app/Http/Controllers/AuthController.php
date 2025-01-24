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

        $redirect = $data['redirect'] ?? null;
        unset($data['redirect']);

        if (!auth()->guard('web')->attempt($data, $remember)) {
            return back()->withInput($request->only('email'))->with('error', 'Thông tin đăng nhập không chính xác');
        }

        if (auth()->guard('web')->user()->status->value == ActiveStatus::InActive->value) {
            auth()->guard('web')->logout();
            return back()->withInput($request->only('email'))->with('error', 'Tài khoản hiện không hoạt động');
        }

        if ($redirect) {
            return redirect()->to($redirect)->with('success', 'Xin chào, ' . auth()->guard('web')->user()->name);
        }

        return redirect()->route('home')->with('success', 'Xin chào, ' . auth()->guard('web')->user()->name);
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

        return redirect()->route('home')->with('success', 'Xin chào, ' . auth()->guard('web')->user()->name);
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
            return back()->withInput($request->only('email'))->with('error', 'Email không tồn tại');
        }

        if ($user->status->value == ActiveStatus::InActive->value) {
            return back()->withInput($request->only('email'))->with('error', 'Tài khoản hiện không hoạt động');
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

        Mail::to($email)->send(new UserSendResetLinkMail($token, $email, $user->name, $device, $time));
        return redirect()->back()->with('success', 'Kiểm tra email để đặt lại mật khẩu');
    }


    public function resetPassword($token, $email)
    {
        return view('client.auth.reset-password', compact('token', 'email'));
    }

    public function logout()
    {
        auth()->guard('web')->logout();
        return redirect()->back()->with('success', 'Đăng xuất thành công');
    }
}
