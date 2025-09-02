<?php

use App\Http\Controllers\RegsitrationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(RegsitrationController::class)
    ->group(function () {
        Route::get('/registered', 'index');
        Route::post('/register', 'store');
    });
