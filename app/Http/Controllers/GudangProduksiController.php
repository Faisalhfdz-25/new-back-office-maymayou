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


        foreach ($data as $item) {
            $totalStock = HistoryProduksi::where('id_inventory', $item->id)->sum('stock');

            $item->stok = $totalStock;
        }

        return view('gudang_produksi.index', compact('data','kelas','penggunaan','jenis','tempat'));
    }

    public function history($id){
        $data_produksi = HistoryProduksi::where('id_inventory', $id)->get();
        return view('gudang_produksi.history', compact('data_produksi'));
    }
}
