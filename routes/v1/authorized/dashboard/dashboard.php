<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;


Route::prefix('dashboard')->name('dashboard.')->middleware(['app.permissions'])->group(static function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
});
