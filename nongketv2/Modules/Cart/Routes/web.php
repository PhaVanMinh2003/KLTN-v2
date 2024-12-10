<?php
use Modules\Cart\Http\Controllers\CartController;
use Modules\Cart\Http\Controllers\CartAddItemController;
use Modules\Cart\Http\Controllers\CartDeleteItemController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::prefix('cart')->middleware('auth')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/update/{item}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/remove/{id}', [CartDeleteItemController::class, 'removeItem'])->name('cart.remove');
    Route::post('/add',[CartAddItemController::class,'addItem'])->name('cart.addItem');
    Route::post('/apply-discount', [CartController::class, 'applyDiscount'])->name('cart.applyDiscount');
});

