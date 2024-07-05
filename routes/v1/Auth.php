<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;


Route::prefix('auth')->name('auth.')->middleware('app.permissions')->group(static function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
