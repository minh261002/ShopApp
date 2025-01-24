<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dang-nhap', [AuthController::class, 'login'])->name('login');
Route::post('/dang-nhap', [AuthController::class, 'handleLogin'])->name('login.post');

Route::get('/dang-ky', [AuthController::class, 'register'])->name('register');
Route::post('/dang-ky', [AuthController::class, 'handleRegister'])->name('register.post');

Route::get('/quen-mat-khau', [AuthController::class, 'forgotPassword'])->name('password.forgot');
Route::post('/quen-mat-khau', [AuthController::class, 'sendEmailResetLink'])->name('password.email');

Route::get('/dat-lai-mat-khau/{token}/{email}', [AuthController::class, 'resetPassword'])->name('password.reset');
Route::post('/dat-lai-mat-khau', [AuthController::class, 'handleResetPassword'])->name('password.reset.post');

Route::get('/san-pham/{slug}', [ProductController::class, 'show'])->name('product.detail');
Route::get('/san-pham', [ProductController::class, 'index'])->name('product.index');
Route::post('/san-pham/chi-tiet', [ProductController::class, 'get'])->name('product.variation.get');

Route::middleware('auth:web')->group(function () {
    Route::post('/dang-xuat', [AuthController::class, 'logout'])->name('logout');
});
