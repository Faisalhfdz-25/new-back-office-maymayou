<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BahanBakuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryListController;
use App\Http\Controllers\JenisKategoriController;
use App\Http\Controllers\KelasProdukController;
use App\Http\Controllers\PenggunaanProdukController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\UserController;
use App\Models\PenggunaanProduk;
use Illuminate\Support\Facades\Route;


Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.authenticate');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');


Route::middleware('auth')->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index');
    });

    Route::controller(InventoryListController::class)->group(function () {
        Route::get('/inventory-list', 'index');
        Route::post('/inventory-list/hapus', 'hapus');
        Route::post('/inventory-list/simpan', 'simpan');
        Route::get('/inventory-list/editview/{id}', 'editview');
        Route::post('/inventory-list/update', 'update');
    });

    Route::controller(SupplierController::class)->group(function () {
        Route::get('/supplier', 'index');
        Route::post('/supplier/hapus', 'hapus');
        Route::post('/supplier/simpan', 'simpan');
        Route::post('/supplier/update', 'update');
        Route::get('/supplier/getDetail', 'getdetail');
    });

    Route::controller(JenisKategoriController::class)->group(function () {
        Route::get('/jenis-kategori', 'index');
        Route::post('/jenis-kategori/hapus', 'hapus');
        Route::post('/jenis-kategori/simpan', 'simpan');
        Route::post('/jenis-kategori/update', 'update');
        Route::get('/jenis-kategori/getDetail', 'getdetail');
    });

    Route::controller(PenggunaanProdukController::class)->group(function () {
        Route::get('/penggunaan-produk', 'index');
        Route::post('/penggunaan-produk/hapus', 'hapus');
        Route::post('/penggunaan-produk/simpan', 'simpan');
        Route::post('/penggunaan-produk/update', 'update');
        Route::get('/penggunaan-produk/getDetail', 'getdetail');
    });

    Route::controller(KelasProdukController::class)->group(function () {
        Route::get('/kelas-produk', 'index');
        Route::post('/kelas-produk/hapus', 'hapus');
        Route::post('/kelas-produk/simpan', 'simpan');
        Route::post('/kelas-produk/update', 'update');
        Route::get('/kelas-produk/getDetail', 'getdetail');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/user', 'index');
        Route::post('/user/delete', 'delete');
        Route::post('/user/store', 'store');
        Route::post('/user/update', 'update');
        Route::get('/user/getDetail', 'getdetail');
    });

    Route::controller(TokoController::class)->group(function () {
        Route::get('/toko', 'index');
        Route::post('/toko/delete', 'delete');
        Route::post('/toko/store', 'store');
        Route::post('/toko/update', 'update');
        Route::get('/toko/getDetail', 'getdetail');
    });
});
