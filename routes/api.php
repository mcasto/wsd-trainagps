<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegsitrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return false;
})->name('login');

Route::controller(RegsitrationController::class)
    ->group(function () {
        Route::get('/registered', 'index')
            ->middleware('auth:sanctum');
        Route::post('/register', 'store');
    });

Route::controller(AuthController::class)
    ->group(function () {
        Route::post('/login', 'login');
        Route::get('/verify-token', function () {
            return true;
        })
            ->middleware('auth:sanctum');
    });
