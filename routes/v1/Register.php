<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Register\RegisterController;

Route::middleware('app.auth')
    ->get('/register', [RegisterController::class, 'index'])->name('register');
