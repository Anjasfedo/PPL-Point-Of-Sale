<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SupplierController;

use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PenjualanProdukController;

use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PembelianProdukController;

use App\Http\Controllers\LoginController;

use App\Http\Controllers\LaporanController;

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

Route::get('/', function () {
    return view('auth.login');
});


Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('loginproses', [LoginController::class, 'login_proses'])->name('loginproses');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('registerproses', [LoginController::class, 'register_proses'])->name('registerproses');

Route::resource('/laporan', LaporanController::class)
->except('show');
Route::get('laporan/detail/{tanggal}', [LaporanController::class, 'show'])->name('detail');


Route::group(['middleware' => 'auth'], function () {

    Route::group(['middleware' => 'role:admin'], function () {

        Route::resource('/kategori', KategoriController::class)
                ->except('edit', 'create', 'show');

        Route::resource('/produk', ProdukController::class)
                ->except('edit', 'create', 'show');

        Route::resource('/supplier', SupplierController::class)
                ->except('edit', 'create', 'show');


        Route::resource('/pembelian', PembelianController::class)
                ->except('edit', 'show', 'destroy', 'create', 'store');
        Route::post('pembelian/{pembelian}', [PembelianController::class, 'store'])->name('pembelian.store');

        Route::resource('/pembelianproduk', PembelianProdukController::class)
                ->except('edit', 'create', 'show', 'store', 'index');
        Route::get('pembelianproduk/index/{pembelianproduk}', [PembelianProdukController::class, 'index'])->name('pembelianproduk.index');
        Route::post('pembelianproduk/{pembelianproduk}', [PembelianProdukController::class, 'store'])->name('pembelianproduk.store');


    });

    Route::group(['middleware' => 'role:admin|kasir'], function () {

        Route::resource('/', DashboardController::class)
                ->except('edit', 'create', 'show', 'store', 'update', 'destroy', 'index');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


        Route::resource('/penjualan', PenjualanController::class)
                ->except('edit', 'show', 'destroy', 'create', 'store');
        Route::post('penjualan/{penjualan}', [PenjualanController::class, 'store'])->name('penjualan.store');

        Route::resource('/penjualanproduk', PenjualanProdukController::class)
                ->except('edit', 'create', 'show', 'store', 'index');
        Route::get('penjualanproduk/index/{penjualanproduk}', [PenjualanProdukController::class, 'index'])->name('penjualanproduk.index');
        Route::post('penjualanproduk/{penjualanproduk}', [PenjualanProdukController::class, 'store'])->name('penjualanproduk.store');
    });
});
