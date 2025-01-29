<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')
    ->prefix('api')
    ->group(function () {
        Route::get('sales', [\App\Http\Controllers\Api\SaleController::class, 'index']);
        Route::post('sales', [\App\Http\Controllers\Api\SaleController::class, 'store']);
});
