<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\PengajuanPurchase;
use Illuminate\Support\Facades\DB;
use App\Models\DetailPengajuanPurchase;
use App\Models\Supplier;

class PengajuanPurchaseController extends Controller
{
    public function purchase(){
        $data = PengajuanPurchase::all();
        return view('pengajuan_purchase.purhcase',compact('data'));
    }
    
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
        $tempat = Supplier::orderBy('id', 'ASC')->get();
        $total = DetailPengajuanPurchase::where('kode', $kode )->sum('sub_total');

        $tanggal = Carbon::now('Asia/Jakarta')->format('d-m-Y');

        $detail = DetailPengajuanPurchase::where('kode', $kode )->get();
        
        return view('pengajuan_purchase.index', compact('data', 'kode', 'detail', 'total', 'tanggal', 'inventory', 'tempat'));
    }


    public function simpan(Request $request)
    {

        
        $data = new DetailPengajuanPurchase();
        DB::beginTransaction();
        try {
            $data->kode = $request->kode;
            $data->id_inventory = $request->id_inventory;
            $data->harga = $request->harga;
            $data->tempat = $request->tempat;
            $data->qty = $request->qty;
            $data->sub_total = $request->sub_total;
            $data->acc = 0;


            if ($data->save()) {
                DB::commit();
                return redirect('/pengajuan-purchase')->with('Save', 'Data Berhasil Disimpan');
            } else {
                DB::rollback();
                return redirect('/pengajuan-purchase')->with('Error', 'Data Gagal Disimpan');
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect('/pengajuan-purchase')->with('Error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    public function ajukan(Request $request)
    {
        $data = new PengajuanPurchase();
        DB::beginTransaction();
        try {
            $data->kode = $request->kode;
            $data->tanggal = Carbon::now('Asia/Jakarta');
            
            
            $totalItem = DetailPengajuanPurchase::count();
            $data->total_item = $totalItem;
            
            
            $data->total_payment = $request->total;

            if ($data->save()) {
                DB::commit();
                return redirect('/pengajuan-purchase')->with('Save', 'Data Berhasil Diajukan');
            } else {
                DB::rollback();
                return redirect('/pengajuan-purchase')->with('Error', 'Data Gagal Diajukan');
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect('/pengajuan-purchase')->with('Error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    public function detail($id){
        $data = PengajuanPurchase::find($id);
        $detail = DetailPengajuanPurchase::where('kode',$data->kode)->get();
        return view('pengajuan_purchase.detail',compact('data','detail'));
    }

    public function acc($id,$status){
        $data = DetailPengajuanPurchase::find($id);
        if($data->acc != 0){
            if($status == 1){
                $purchase = PengajuanPurchase::where('kode',$data->kode)->first();
                $purchase->total_payment = $purchase->total_payment + $data->sub_total;
                $purchase->update(); 
            }
        }
        $data->acc = $status;
        if($status == 2){
            $purchase = PengajuanPurchase::where('kode',$data->kode)->first();
            $purchase->total_payment = $purchase->total_payment - $data->sub_total;
            $purchase->update(); 
        }
        $data->update();
        return redirect()->back();
    }

    public function setujui($kode){
        $data = PengajuanPurchase::where('kode',$kode)->first();
        $data->acc = 1;
        $data->update();
        return redirect()->back();
    }

}
