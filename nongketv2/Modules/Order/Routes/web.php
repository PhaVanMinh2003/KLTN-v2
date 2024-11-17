<?php
use Modules\Order\Http\Controllers\OrderController;
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

Route::prefix('order')->group(function() {
    Route::get('/create', [OrderController::class, 'createOrder'])->name('order.create');
    Route::post('/store', [OrderController::class, 'storeOrder'])->name('order.store');
    Route::get('/success', [OrderController::class, 'success'])->name('order.success');
});

