<?php

namespace App\Http\Controllers;

use App\Models\HistoryProduksi;
use App\Models\Supplier;
use App\Models\Inventory;
use App\Models\KelasProduk;
use Illuminate\Http\Request;
use App\Models\JenisKategori;
use App\Models\PenggunaanProduk;

class GudangProduksiController extends Controller
{
    public function index () {
        $data = Inventory::where('is_produksi', true)->get();
        $kelas = KelasProduk::orderBy('id', 'ASC')->get();
        $penggunaan = PenggunaanProduk::orderBy('id', 'ASC')->get();
        $jenis = JenisKategori::orderBy('id','ASC')->get();
        $tempat = Supplier::orderBy('id','ASC')->get();
        return view('gudang_produksi.index',compact('data','kelas','penggunaan','jenis','tempat'));
    }

    public function history(){
        $data = HistoryProduksi::all();
        return view('gudang_produksi.history', compact('data'));
    }
}
