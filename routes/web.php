<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GudangFrozenController;
use App\Http\Controllers\GudangProduksiController;
use App\Http\Controllers\GudangPurchaseController;
use App\Http\Controllers\GudangTokoController;
use App\Http\Controllers\InventoryListController;
use App\Http\Controllers\JenisKategoriController;
use App\Http\Controllers\KelasProdukController;
use App\Http\Controllers\PengajuanPurchaseController;
use App\Http\Controllers\PenggunaanProdukController;
use App\Http\Controllers\roleController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\UserController;
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
        Route::get('/inventory-list/resep/{id}', 'resep');
        Route::post('/inventory-list/resep/simpan', 'simpanresep');
        Route::post('/inventory-list/resep/hapus', 'hapusresep');
    });

    Route::controller(SupplierController::class)->group(function () {
        Route::get('/supplier', 'index');
        Route::get('/supplier/getdata', 'getData');
        Route::post('/supplier/hapus', 'hapus');
        Route::post('/supplier/simpan', 'simpan');
        Route::post('/supplier/update', 'update');
        Route::get('/supplier/getDetail', 'getdetail');
    });

    Route::controller(JenisKategoriController::class)->group(function () {
        Route::get('/jenis-kategori', 'index');
        Route::get('/jenis-kategori/getdata', 'getData');
        Route::post('/jenis-kategori/hapus', 'hapus');
        Route::post('/jenis-kategori/simpan', 'simpan');
        Route::post('/jenis-kategori/update', 'update');
        Route::get('/jenis-kategori/getDetail', 'getdetail');
    });

    Route::controller(PenggunaanProdukController::class)->group(function () {
        Route::get('/penggunaan-produk', 'index');
        Route::get('/penggunaan-produk/getdata', 'getData');
        Route::post('/penggunaan-produk/hapus', 'hapus');
        Route::post('/penggunaan-produk/simpan', 'simpan');
        Route::post('/penggunaan-produk/update', 'update');
        Route::get('/penggunaan-produk/getDetail', 'getdetail');
    });

    Route::controller(KelasProdukController::class)->group(function () {
        Route::get('/kelas-produk', 'index');
        Route::get('/kelas-produk/getdata', 'getData');
        Route::post('/kelas-produk/hapus', 'hapus');
        Route::post('/kelas-produk/simpan', 'simpan');
        Route::post('/kelas-produk/update', 'update');
        Route::get('/kelas-produk/getDetail', 'getdetail');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/user', 'index');
        Route::get('/user/getdata', 'getData');
        Route::post('/user/delete', 'delete');
        Route::post('/user/store', 'store');
        Route::post('/user/update', 'update');
        Route::get('/user/getDetail', 'getdetail');
    });

    Route::controller(TokoController::class)->group(function () {
        Route::get('/toko', 'index');
        Route::get('/toko/getdata', 'getData');
        Route::post('/toko/delete', 'delete');
        Route::post('/toko/store', 'store');
        Route::post('/toko/update', 'update');
        Route::get('/toko/getDetail', 'getdetail');
    });

    Route::controller(roleController::class)->group(function () {
        Route::get('/role', 'index');
        Route::get('/role/getdata', 'getData');
        Route::post('/role/delete', 'delete');
        Route::post('/role/store', 'store');
        Route::post('/role/update', 'update');
        Route::get('/role/getDetail', 'getdetail');
    });

    Route::controller(GudangPurchaseController::class)->group(function (){
        Route::get('/gudang-purchase', 'index');
        Route::get('/gudang-purchase/history/{id}', 'history');
    });

    Route::controller(GudangProduksiController::class)->group(function (){
        Route::get('/gudang-produksi', 'index');
        Route::get('/gudang-produksi/history/{id}', 'history');
    });

    Route::controller(GudangTokoController::class)->group(function (){
        Route::get('/gudang-toko', 'index');
        Route::get('/gudang-toko/history/{id}', 'history');
    });

    Route::controller(GudangFrozenController::class)->group(function (){
        Route::get('/gudang-frozen', 'index');
        Route::get('/gudang-frozen/history/{id}', 'history');
    });

    Route::controller(PengajuanPurchaseController::class)->group(function () {
        Route::get('/pengajuan-purchase', 'purchase');
        Route::get('/pengajuan-purchase-tambah', 'index');
        Route::get('/pengajuan-purchase-setujui/{id}', 'setujui');
        Route::get('/pengajuan-purchase-acc/{id}/{status}', 'acc');
        Route::get('/pengajuan-purchase-detail/{id}', 'detail');
        Route::post('/pengajuan-purchase/simpan', 'simpan');
        Route::post('/pengajuan-purchase/ajukan', 'ajukan');
    });
});
