<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect()->route('sales.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/sales', [\App\Http\Controllers\SalesController::class, 'index'])->name('sales.index');
});

require __DIR__.'/api.php';
require __DIR__.'/auth.php';
