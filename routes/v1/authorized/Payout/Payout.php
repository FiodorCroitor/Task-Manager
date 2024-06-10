<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Payout\PayoutController;

Route::prefix('payouts')->name('payout.')->group(function () {
    Route::middleware(['app.permissions'])
        ->get('/', [PayoutController::class, 'index'])
        ->name('index');

    Route::middleware(['app.permissions'])
        ->post('/', [PayoutController::class, 'store'])
        ->name('store');
    Route::middleware(['app.permissions'])
        ->get('/{payout}/edit', [PayoutController::class, 'edit'])
        ->name('edit');
    Route::middleware(['app.permissions'])
        ->get('{payout}/update' , [PayoutController::class , 'update'])
        ->name('update');
    Route::middleware(['app.permissions'])
        ->delete('destroy', [PayoutController::class, 'destroy'])
        ->name('delete');
});
