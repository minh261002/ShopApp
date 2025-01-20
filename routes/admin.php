<?php
use Illuminate\Support\Facades\Route;
use App\Admin\Http\Controllers\Auth\AuthController;

Route::middleware(['admin'])->prefix('admin')->as('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'handleLogin'])->name('login.post');

    Route::get('/password/forgot', [AuthController::class, 'forgotPassword'])->name('password.forgot');
    Route::post('/password/email', [AuthController::class, 'sendResetLink'])->name('password.email');

    Route::get('/password/reset', [AuthController::class, 'resetPassword'])->name('password.reset');
    Route::post('/password/update', [AuthController::class, 'updatePassword'])->name('password.update');
});
