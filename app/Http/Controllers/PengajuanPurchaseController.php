<?php

namespace App\Http\Controllers;

use App\Models\DetailPengajuanPurchase;
use App\Models\PengajuanPurchase;
use Illuminate\Http\Request;

class PengajuanPurchaseController extends Controller
{
    public function index()
    {
        $data = PengajuanPurchase::all();

        return view('pengajuan_purchase.index', compact('data'));
    }

    public function detail($id)
    {
        $data = DetailPengajuanPurchase::where('id_pengajuan', $id)->get();
        return view('pengajuan_purchase.detail', compact('data'));
    }
}
