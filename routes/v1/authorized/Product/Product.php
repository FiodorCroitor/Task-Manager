<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Product\ProductController;


Route::prefix('products')->name('product.')->group(function () {
    Route::middleware('app.permissions')
        ->get('/', [ProductController::class, 'index'])
        ->name('index');
    Route::middleware('app.permissions')
        ->post('/', [ProductController::class, 'store'])
        ->name('store');
    Route::middleware('app.permissions')
        ->get('{product}/edit', [ProductController::class, 'edit'])
        ->name('edit');
    Route::middleware('app.permissions')
        ->get('{product}/update', [ProductController::class, 'update'])
        ->name('update');
    Route::middleware('app.permissions')
    ->delete('delete', [ProductController::class, 'destroy'])
        ->name('delete');
});
