<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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

// Route cho layout chính
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/home-content', [HomeController::class, 'homeContent'])->name('homecontent');
Route::get('/products-list', [HomeController::class, 'productlist'])->name('productlist');

Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/autocomplete', [HomeController::class, 'autocomplete'])->name('autocomplete');

Route::post('/update-product', [HomeController::class, 'updateProductQuantity']);
Route::get('/', [HomeController::class, 'FeaturedProducts'])->name('FeaturedProducts');
Route::get('/products/{id}', [HomeController::class, 'showProductDetail'])->name('showProductDetail');

