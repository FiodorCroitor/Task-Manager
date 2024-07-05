<?php

declare(strict_types=1);

use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('users')->name('users.')->group(function () {
    Route::middleware(['app.permissions'])
        ->get('/', [UserController::class, 'index'])
        ->name('index');

    Route::middleware(['app.permissions'])
        ->post('/', [UserController::class, 'store'])
        ->name('store');

    Route::middleware(['app.permissions'])
        ->get('create', [UserController::class, 'create'])
        ->name('create');

    Route::middleware(['app.permissions'])
        ->get('{user}/edit', [UserController::class, 'edit'])
        ->name('edit');

    Route::middleware(['app.permissions'])
        ->post('{user}/update', [UserController::class, 'update'])
        ->name('update');

    Route::middleware(['app.permissions'])
        ->post('{user}/destroy', [UserController::class, 'delete'])
        ->name('delete');
});
