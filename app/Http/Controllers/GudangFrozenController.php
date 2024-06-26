<?php

namespace App\Http\Controllers;

use App\Models\HistoryFrozen;
use App\Models\Supplier;
use App\Models\Inventory;
use App\Models\KelasProduk;
use Illuminate\Http\Request;
use App\Models\JenisKategori;
use App\Models\PenggunaanProduk;

class GudangFrozenController extends Controller
{
    public function index()
    {
        $data = Inventory::where('is_frozen', true)->get();
        $kelas = KelasProduk::orderBy('id', 'ASC')->get();
        $penggunaan = PenggunaanProduk::orderBy('id', 'ASC')->get();
        $jenis = JenisKategori::orderBy('id','ASC')->get();
        $tempat = Supplier::orderBy('id','ASC')->get();

        foreach ($data as $item) {
            $totalStock = HistoryFrozen::where('id_inventory', $item->id)->sum('stock');

            $item->stok = $totalStock;
        }

        return view('gudang_frozen.index',compact('data','kelas','penggunaan','jenis','tempat'));
    }

    public function history($id){
         
        $data = HistoryFrozen::where('id_inventory', $id)->get();
        return view('gudang_frozen.history', compact('data'));
    }
}
