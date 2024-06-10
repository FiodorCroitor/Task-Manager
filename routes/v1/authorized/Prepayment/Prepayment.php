<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Prepayment\PrepaymentController;


Route::prefix('prepayments')->name('prepayment.')->group(function () {
    Route::middleware('app.permissions')
        ->get('/', [PrepaymentController::class, 'index'])
        ->name('index');
    Route::middleware('app.permissions')
        ->post('/', [PrepaymentController::class, 'store'])
        ->name('store');
    Route::middleware('app.permissions')
        ->get('/{prepayment}/edit', [PrepaymentController::class, 'edit'])
        ->name('edit');
    Route::middleware('app.permissions')
        ->get('/{prepayment}/update', [PrepaymentController::class, 'update'])
        ->name('update');
    Route::middleware('app.permissions')
        ->get('delete', [PrepaymentController::class, 'destroy'])
        ->name('delete');
});
