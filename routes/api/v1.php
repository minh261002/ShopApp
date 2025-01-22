<?php

namespace Routes\Api;

use App\Api\V1\Http\Controllers\Auth\AuthController;
use App\Api\V1\Http\Controllers\Category\CategoryController;
use App\Api\V1\Http\Controllers\Discount\DiscountController;
use App\Api\V1\Http\Controllers\FlashSale\FlashSaleController;
use App\Api\V1\Http\Controllers\Order\OrderController;
use App\Api\V1\Http\Controllers\Product\ProductController;
use App\Api\V1\Http\Controllers\Slider\SliderController;
use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'v1',
    'middleware' => []
], function () {
    Route::get('/provinces', [LocationController::class, 'getProvinces']);
    Route::get('/districts/{province_code}', [LocationController::class, 'getDistricts']);
    Route::get('/wards/{district_code}', [LocationController::class, 'getWards']);


    Route::group([
        'middleware' => ['jwt'],
    ], function ($router) {
        Route::post('auth/logout', [AuthController::class, 'logout']);
        Route::get('auth/me', [AuthController::class, 'me']);

        Route::prefix('discount')->group(function () {
            Route::get('/my', [DiscountController::class, 'showMyDiscount']);
            Route::post('/apply', [DiscountController::class, 'applyDiscount']);
        });
    });

    Route::post('auth/login', [AuthController::class, 'login']);
    Route::post('auth/register', [AuthController::class, 'register']);
    Route::post('/auth/password/forgot', [AuthController::class, 'forgotPassword']);
    Route::post('auth/reset-password', [AuthController::class, 'resetPassword'])->name('password.reset');

    Route::prefix('sliders')->group(function () {
        Route::get('/', [SliderController::class, 'index']);
        Route::get('/{key}', [SliderController::class, 'show']);
    });

    Route::prefix('category')->group(function () {
        Route::get('/menu', [CategoryController::class, 'getCategoryInMenu']);
        Route::get('/home', [CategoryController::class, 'getCategoryInHome']);
    });

    Route::prefix('discount')->group(function () {
        Route::get('/home', [DiscountController::class, 'showHome']);
    });

    Route::prefix('flash-sale')->group(function () {
        Route::get('/', [FlashSaleController::class, 'index']);
    });

    // Route::prefix('product')->group(function () {
    //     Route::get('/show/{slug}', [ProductController::class, 'show']);
    //     Route::get('/new', [ProductController::class, 'new']);
    // });

    // Route::prefix('order')->group(function () {
    //     Route::post('/store', [OrderController::class, 'store']);
    //     Route::post('/shipping-fee', [OrderController::class, 'caculateShippingFee']);
    //     Route::patch('/update-success', [OrderController::class, 'updateSuccess']);
    // });

    // Route::middleware(['jwt', 'auth:api'])->group(function () {
    //     Route::prefix('product')->group(function () {
    //         Route::get('/show/{slug}', [ProductController::class, 'show']);
    //         Route::get('/new', [ProductController::class, 'new']);
    //     });
    // });
});