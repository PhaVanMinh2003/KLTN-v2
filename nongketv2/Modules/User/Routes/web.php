<?php
use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\AuthController;
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
Route::group(['namespace' => 'Modules\User\Http\Controllers'], function() {

    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('user.register.form');
    Route::post('/register', [AuthController::class, 'register'])->name('user.register');
    
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('user.login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('user.login');

    Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('user.forgot-password.form');
    Route::post('/forgot-password', [AuthController::class, 'submitForgotPassword'])->name('user.forgot-password.submit');
});

