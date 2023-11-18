<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CategoryController;
use Illuminate\Support\Facades\Route;

Route::namespace('Api/V1')->group(function () {
    Route::post('login', [AuthController::class, 'login']);

    Route::post('categories', [CategoryController::class, 'store']);
    Route::get('categories/{category}', [CategoryController::class, 'show']);
    Route::post('categories/{category}', [CategoryController::class, 'update']);
});
