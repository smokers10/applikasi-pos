<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LoginCashierController;

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Cashier\HomeController as CashierHomeController;


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

// Login Admin
Route::get('/', [LoginController::class, 'LoginPage'])->name('admin.login');

// Admin
Route::prefix('admin')->group(function () {
    Route::post('/login', [LoginController::class, 'authenticate'])->name('admin.login.post');
    Route::get('/home', [HomeController::class, 'Home'])->name('admin.home');
});

// cashier
Route::prefix('cashier')->group(function () {
    Route::get('/login', [LoginCashierController::class, 'LoginPage'])->name('cashier.login');
    Route::post('/login', [LoginCashierController::class, 'authenticate'])->name('cashier.login.post');
    Route::get('/home', [CashierHomeController::class, 'Home'])->name('cashier.home');
});