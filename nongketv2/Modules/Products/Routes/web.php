<?php
use Modules\Products\Http\Controllers\ProductsController;
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

Route::prefix('products')->middleware(['auth', 'farmer'])->group(function () {
    Route::get('/', [ProductsController::class, 'index'])->name('products.index');
    Route::post('/create', [ProductsController::class, 'store'])->name('products.store');
});
