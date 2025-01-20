<?php

namespace App\Admin\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;


class AuthController extends Controller
{
    public function login(): View
    {
        return view('admin.auth.login');
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
