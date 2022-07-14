<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;

Route::controller(AuthController::class)->group(function () {

    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout');
    Route::post('/checktoken', 'checkToken');
});

Route::controller(CategoryController::class)->group(function () {

    Route::get('categories', 'index');
    Route::post('categories', 'store');
});
