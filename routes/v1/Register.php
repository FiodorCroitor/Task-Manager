<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;

Route::get('register' , [RegisterController::class, 'index'])->name('register');
Route::post('store' , [RegisterController::class, 'store'])->name('store');
