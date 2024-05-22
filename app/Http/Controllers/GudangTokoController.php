<?php

namespace App\Http\Controllers;

use App\Models\HistoryToko;
use App\Models\Supplier;
use App\Models\Inventory;
use App\Models\KelasProduk;
use Illuminate\Http\Request;
use App\Models\JenisKategori;
use App\Models\PenggunaanProduk;

class GudangTokoController extends Controller
{
    public function index ()
    {
        $data = Inventory::where('is_toko', true)->get();
        $kelas = KelasProduk::orderBy('id', 'ASC')->get();
        $penggunaan = PenggunaanProduk::orderBy('id', 'ASC')->get();
        $jenis = JenisKategori::orderBy('id','ASC')->get();
        $tempat = Supplier::orderBy('id','ASC')->get();
        return view('gudang_toko.index',compact('data','kelas','penggunaan','jenis','tempat'));
    }

    public function history(){
        $data = HistoryToko::all();
        return view('gudang_toko.history', compact('data'));
    }
}
