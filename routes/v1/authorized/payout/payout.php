<?php

declare(strict_types=1);

use App\Http\Controllers\Payout\PayoutController;
use Illuminate\Support\Facades\Route;

Route::prefix('payouts')->name('payouts.')->group(function () {
    Route::middleware(['app.permissions'])
        ->get('/', [PayoutController::class, 'index'])
        ->name('index');

    Route::middleware(['app.permissions'])
        ->post('store', [PayoutController::class, 'store'])
        ->name('store');

    Route::middleware(['app.permissions'])
        ->get('create', [PayoutController::class, 'create'])
        ->name('create');

    Route::middleware(['app.permissions'])
        ->get('{payout}/edit', [PayoutController::class, 'edit'])
        ->name('edit');

    Route::middleware(['app.permissions'])
        ->post('{payout}/update', [PayoutController::class, 'update'])
        ->name('update');

    Route::middleware(['app.permissions'])
        ->post('{payout}/delete', [PayoutController::class, 'delete'])
        ->name('delete');

});
