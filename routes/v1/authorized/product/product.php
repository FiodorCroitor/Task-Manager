<?php

declare(strict_types=1);

use App\Http\Controllers\Product\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('products')->name('products.')->group(function () {
    Route::middleware(['app.permissions'])
        ->get('/', [ProductController::class, 'index'])
        ->name('index')
    ;
    Route::middleware(['app.permissions'])
        ->get('/create', [ProductController::class, 'create'])
        ->name('create')
    ;
    Route::middleware(['app.permissions'])
        ->post('/', [ProductController::class, 'store'])
        ->name('store')
    ;
    Route::middleware(['app.permissions'])
        ->get('{product}/edit', [ProductController::class, 'edit'])
        ->name('edit')
    ;
    Route::middleware(['app.permissions'])
        ->post('{product}/update', [ProductController::class, 'update'])
        ->name('update')
    ;
    Route::middleware(['app.permissions'])
        ->post('{product}/delete', [ProductController::class, 'delete'])
        ->name('delete')
    ;
    Route::middleware(['app.permissions'])
        ->post('{products}/media/delete', [ProductController::class, 'deleteProductMedia'])
        ->name('media.delete')
    ;
});
