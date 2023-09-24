<?php

use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PenjualanProdukController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('layout.main');
// });

Route::resource('/', DashboardController::class)
        ->except('edit', 'create', 'show', 'store', 'update', 'destroy');

Route::resource('/kategori', KategoriController::class)
        ->except('edit', 'create', 'show');

Route::resource('/produk', ProdukController::class)
        ->except('edit', 'create', 'show');

Route::resource('/supplier', SupplierController::class)
        ->except('edit', 'create', 'show');

Route::resource('/penjualan', PenjualanController::class)
        ->except('edit', 'show', 'store', 'destroy');
Route::post('/penjualan/{penjualan}', [PenjualanController::class, 'store'])->name('penjualan.store');

Route::resource('/penjualanproduk', PenjualanProdukController::class)
        ->except('edit', 'create', 'show', 'store');
Route::post('penjualanproduk/{penjualanproduk}', [PenjualanProdukController::class, 'store'])->name('penjualanproduk.store');