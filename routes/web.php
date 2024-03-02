<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;

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

Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

Route::get('/pegawai', [PegawaiController::class, 'index'])->middleware('auth');
Route::post('/pegawai/store', [PegawaiController::class, 'store'])->middleware('auth');
Route::put('/pegawai/{id}', [PegawaiController::class, 'update'])->middleware('auth');
Route::delete('/pegawai/{id}', [PegawaiController::class, 'destroy'])->middleware('auth');

Route::get('/kategori', [CategoryController::class, 'index'])->middleware('auth');
Route::post('/kategori/store', [CategoryController::class, 'store'])->middleware('auth');
Route::put('/kategori/{id}', [CategoryController::class, 'update'])->middleware('auth');
Route::delete('/kategori/{id}', [CategoryController::class, 'destroy'])->middleware('auth');

Route::get('/produk', [ProductController::class, 'index'])->middleware('auth');
Route::post('/produk/store', [ProductController::class, 'store'])->middleware('auth');
Route::put('/produk/{id}', [ProductController::class, 'update'])->middleware('auth');
Route::delete('/produk/{id}', [ProductController::class, 'destroy'])->middleware('auth');




