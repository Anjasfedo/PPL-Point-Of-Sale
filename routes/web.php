<?php


use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;

use App\Http\Controllers\KategoriController;

use App\Http\Controllers\SupplierController;

use App\Http\Controllers\BarangController;

use App\Http\Controllers\PenjualanController;

use App\Http\Controllers\PenjualanBarangController;

use App\Http\Controllers\PembelianController;

use App\Http\Controllers\PembelianBarangController;

use App\Http\Controllers\LaporanController;

use App\Http\Controllers\HomeController;

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

Auth::routes();

// Route::post('/register', [UserController::class, 'store'])->name("register.user");

Route::group(['middleware' => 'auth'], function () {

        Route::group(['middleware' => 'role:admin'], function () {
                Route::resource('/kategori', KategoriController::class)
                        ->except('edit', 'create', 'show');
                Route::post('kategori-import', [KategoriController::class, 'kategoriImport'])->name('kategori-import');

                Route::resource('/barang', BarangController::class)
                        ->except('edit', 'create', 'show');
                Route::post('barang-import', [BarangController::class, 'barangImport'])->name('barang-import');

                Route::resource('/supplier', SupplierController::class)
                        ->except('edit', 'create', 'show');
                Route::post('supplier-import', [SupplierController::class, 'supplierImport'])->name('supplier-import');

                Route::resource('/pembelian', PembelianController::class)
                        ->except('edit', 'show', 'destroy', 'create', 'store');
                Route::post('pembelian/{pembelian}', [PembelianController::class, 'store'])->name('pembelian.store');
                Route::get('pembelian/notaPembelian', [PembelianController::class, 'notaPembelian'])->name('pembelian.notaPembelian');

                Route::resource('/pembelianbarang', PembelianBarangController::class)
                        ->except('edit', 'create', 'show', 'store', 'index');
                Route::get('pembelianbarang/index/{pembelianbarang}', [PembelianBarangController::class, 'index'])->name('pembelianbarang.index');
                Route::post('pembelianbarang/{pembelianbarang}', [PembelianBarangController::class, 'store'])->name('pembelianbarang.store');

                Route::resource('/laporan', LaporanController::class)
                        ->except('show');
                Route::get('laporan/detail/{tanggal}', [LaporanController::class, 'show'])->name('detail');

                Route::resource('/user', UserController::class)
                        ->except('edit', 'create', 'show');
                Route::get('user-profile', [UserController::class, 'profile'])->name('user-profile');
                Route::put('user-profile-update', [UserController::class, 'profileUpdate'])->name('user-profile-update');
        });

        Route::group(['middleware' => 'role:admin|kasir'], function () {
                Route::get('/home', [HomeController::class, 'index'])->name('home');
                Route::resource('/dashboard', DashboardController::class);

                Route::resource('/penjualan', PenjualanController::class)
                        ->except('edit', 'show', 'destroy', 'create', 'store');
                Route::get('penjualan/notaPenjualan', [PenjualanController::class, 'notaPenjualan'])->name('penjualan.notaPenjualan');

                Route::post('penjualan/{penjualan}', [PenjualanController::class, 'store'])->name('penjualan.store');

                Route::resource('/penjualanbarang', PenjualanBarangController::class)
                        ->except('edit', 'create', 'show', 'store', 'index');
                Route::get('penjualanbarang/index/{penjualanbarang}', [PenjualanBarangController::class, 'index'])->name('penjualanbarang.index');
                Route::post('penjualanbarang/{penjualanbarang}', [PenjualanBarangController::class, 'store'])->name('penjualanbarang.store');

                Route::get('user-profile', [UserController::class, 'profile'])->name('user-profile');
                Route::put('user-profile-update/{id}', [UserController::class, 'profileUpdate'])->name('user-profile-update');
        });
});
