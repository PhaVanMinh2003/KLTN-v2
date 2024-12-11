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

Route::prefix('order')->middleware('auth')->group(function () {
    Route::get('/', 'OrderController@index')->name('order.index');
    Route::post('/create', [OrderController::class, 'createOrder'])->name('order.create');
    Route::get('/order/success', function () {
        return view('order_success');
    })->name('order.success');
});

