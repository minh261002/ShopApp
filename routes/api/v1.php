<?php

use Illuminate\Support\Facades\Route;

Route::get('/v1', function () {
    return response()->json(['message' => 'Hello World!']);
});
