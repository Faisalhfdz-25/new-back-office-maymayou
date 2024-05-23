<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\PengajuanPurchase;
use App\Models\DetailPengajuanPurchase;
use App\Models\Inventory;

class PengajuanPurchaseController extends Controller
{
    public function index()
    {
        
        $tanggalSekarang = Carbon::now('Asia/Jakarta')->format('dmy');
        
        $lastPurchase = PengajuanPurchase::where('kode', 'LIKE', 'INV-PUR-' . $tanggalSekarang . '%')
                        ->orderBy('kode', 'desc')
                        ->first();

        if ($lastPurchase) {
            $lastNumber = (int)substr($lastPurchase->kode, -2);
            $newNumber = str_pad($lastNumber + 1, 2, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '01';
        }

        $kode = 'INV-PUR-' . $tanggalSekarang . $newNumber;
        
        
        $data = PengajuanPurchase::all();
        $inventory = Inventory::all();
        $total = DetailPengajuanPurchase::sum('harga');

        $tanggal = Carbon::now('Asia/Jakarta')->format('d-m-Y');

        $detail = DetailPengajuanPurchase::with('inventory')->get();
        return view('pengajuan_purchase.index', compact('data', 'kode', 'detail','total' ,'tanggal', 'inventory'));
    }

    
}
