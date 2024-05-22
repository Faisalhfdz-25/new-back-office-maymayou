<?php

namespace App\Http\Controllers;

use App\Models\HistoryPurchase;
use App\Models\Supplier;
use App\Models\Inventory;
use App\Models\KelasProduk;
use Illuminate\Http\Request;
use App\Models\JenisKategori;
use App\Models\PenggunaanProduk;

class GudangPurchaseController extends Controller
{
    public function index()
    {
        $data = Inventory::all();
        $kelas = KelasProduk::orderBy('id', 'ASC')->get();
        $penggunaan = PenggunaanProduk::orderBy('id', 'ASC')->get();
        $jenis = JenisKategori::orderBy('id', 'ASC')->get();
        $tempat = Supplier::orderBy('id', 'ASC')->get();


        foreach ($data as $item) {
            $totalStock = HistoryPurchase::where('id_inventory', $item->id)->sum('stock');

            $item->stok = $totalStock;
        }

        return view('gudang_purchase.index', compact('data', 'kelas', 'penggunaan', 'jenis', 'tempat'));
    }

    public function history($id)
    {
        $data = HistoryPurchase::where('id_inventory', $id)->get();
        return view('gudang_purchase.history', compact('data'));
    }
}
