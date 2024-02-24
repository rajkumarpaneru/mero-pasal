<?php

use App\Http\Controllers\Api\SubCategoryController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\BrandController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\SellerController;
use Illuminate\Support\Facades\Route;

Route::namespace('Api/V1')->group(function () {
    Route::post('login', [AuthController::class, 'login']);

    //categories
    Route::get('categories', [CategoryController::class, 'index']);
    Route::post('categories', [CategoryController::class, 'store']);
    Route::get('categories/{category}', [CategoryController::class, 'show']);
    Route::post('categories/{category}', [CategoryController::class, 'update']);
    Route::delete('categories/{category}', [CategoryController::class, 'destroy']);

    //sub-categories
    Route::get('categories/{category}/sub-categories', [SubCategoryController::class, 'index']);
    Route::post('categories/{category}/sub-categories',
        [SubCategoryController::class, 'store']);
    Route::get('categories/{category}/sub-categories/{subCategory}',
        [SubCategoryController::class, 'show']);
    Route::post('categories/{category}/sub-categories/{subCategory}',
        [SubCategoryController::class, 'update']);
    Route::delete('categories/{category}/sub-categories/{subCategory}',
        [SubCategoryController::class, 'destroy']);

    //brands
    Route::get('brands', [BrandController::class, 'index']);
    Route::post('brands', [BrandController::class, 'store']);
    Route::get('brands/{brand}', [BrandController::class, 'show']);
    Route::post('brands/{brand}', [BrandController::class, 'update']);
    Route::delete('brands/{brand}', [BrandController::class, 'destroy']);


    //sellers
    Route::post('sellers', [SellerController::class, 'store']);

    Route::post('sellers/{seller}', [SellerController::class, 'update']);

    Route::get('sellers/{seller}', [SellerController::class, 'show']);

    Route::get('sellers', [SellerController::class, 'index']);

    Route::delete('sellers/{seller}', [SellerController::class, 'destroy']);

});
