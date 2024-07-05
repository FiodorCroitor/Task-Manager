<?php

declare(strict_types=1);

use App\Http\Controllers\Prepayment\PrepaymentController;
use Illuminate\Support\Facades\Route;

Route::prefix('prepayments')->name('prepayments.')->group(function () {
    Route::middleware(['app.permissions'])
        ->get('/', [PrepaymentController::class, 'index'])
        ->name('index')
    ;
    Route::middleware(['app.permissions'])
        ->post('/store', [PrepaymentController::class, 'store'])
        ->name('store')
    ;
    Route::middleware(['app.permissions'])
        ->get('create', [PrepaymentController::class, 'create'])
        ->name('create')
    ;
    Route::middleware(['app.permissions'])
        ->get('{prepayment}/edit', [PrepaymentController::class, 'edit'])
        ->name('edit')
    ;
    Route::middleware(['app.permissions'])
        ->post('{prepayment}/update', [PrepaymentController::class, 'update'])
        ->name('update')
    ;
    Route::middleware(['app.permissions'])
        ->post('{prepayment}/delete', [PrepaymentController::class, 'delete'])
        ->name('delete')
    ;
});
