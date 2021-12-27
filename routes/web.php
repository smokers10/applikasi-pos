<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StokUnitController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\UserController;


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
Route::get('/', [LoginController::class, 'login'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest')->name('login.post');
Route::get('/logout', [LoginController::class, 'logout']);

// Home
Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');

// Admin
Route::middleware("admin")->prefix('product')->group(function () {
    Route::get('/category',[CategoryController::class, 'index'])->name('category');
    Route::post('/category/update',[CategoryController::class, 'update'])->name('category.update');
    Route::post('/category/create',[CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/delete',[CategoryController::class, 'delete'])->name('category.delete');

    Route::get('/stock-unit',[StokUnitController::class, 'index'])->name('stock-unit');
    Route::post('/stock-unit/update',[StokUnitController::class, 'update'])->name('stok-unit.update');
    Route::post('/stock-unit/create',[StokUnitController::class, 'create'])->name('stok-unit.create');
    Route::post('/stock-unit/delete',[StokUnitController::class, 'delete'])->name('stok-unit.delete');

    Route::get('/', [ProductController::class, 'index'])->name('product');
});

// Fitur Cashier
Route::middleware('auth')->prefix('/cashier')->group(function () {
    Route::get('/', [CashierController::class, 'index'])->name('cashier');
});

// user
Route::middleware("admin")->prefix('user')->group(function(){
    Route::get('/', [UserController::class, 'index'])->name('user');
    Route::post('/update', [UserController::class, 'update'])->name('user.update');
    Route::post('/create', [UserController::class, 'create'])->name('user.create');
    // Route::post('/delete', [UserController::class, 'delete'])->name('user.delete');
});



