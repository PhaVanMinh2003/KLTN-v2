<?php
use Modules\Cart\Http\Controllers\CartController;
use Modules\Cart\Http\Controllers\CartAddItemController;
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
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/update/{item}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::delete('/cart/remove/{item}', [CartController::class, 'removeItem'])->name('cart.removeItem');
    Route::post('/cart/add',[CartAddItemController::class,'addItem'])->name('cart.addItem');
    Route::post('/cart/apply-discount', [CartController::class, 'applyDiscountCode'])->name('cart.applyDiscountCode');
});
