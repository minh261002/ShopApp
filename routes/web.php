<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dang-nhap', [AuthController::class, 'login'])->name('login');
Route::post('/dang-nhap', [AuthController::class, 'postLogin'])->name('postLogin');

Route::get('/dang-ky', [AuthController::class, 'register'])->name('register');
Route::post('/dang-ky', [AuthController::class, 'postRegister'])->name('postRegister');