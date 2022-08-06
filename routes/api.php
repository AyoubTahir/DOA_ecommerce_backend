<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;

Route::controller(AuthController::class)->group(function () {

    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout');
    Route::post('/checktoken', 'checkToken');
});

Route::controller(CategoryController::class)->group(function () {
    Route::get('categories', 'index');
    Route::get('categories/{id}', 'show');
    Route::post('categories', 'store')->name('addCategory');
    Route::post('categories/{id}', 'update');
    Route::delete('categories/{id}', 'destroy');
});

Route::controller(ProductController::class)->group(function () {
    Route::get('products', 'index');
    Route::get('products/{id}', 'show');
    Route::post('products', 'store');
    Route::post('products/{id}', 'update');
    Route::delete('products/{id}', 'destroy');
});
