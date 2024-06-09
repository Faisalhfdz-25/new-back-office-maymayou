<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\PengajuanPurchase;
use Illuminate\Support\Facades\DB;
use App\Models\DetailPengajuanPurchase;
use App\Models\Notifikasi;
use App\Models\Supplier;
use Egulias\EmailValidator\Result\Reason\DetailedReason;
use Illuminate\Support\Facades\Auth;

class PengajuanPurchaseController extends Controller
{
    public function purchase(){
        return view('pengajuan_purchase.purhcase');
    }
    
    public function getData(){
        $datas = PengajuanPurchase::all();
        foreach($datas as $data){
            $data->kode = $data->kode;
            $data->item = $data->total_item;
            $data->total = $data->total_payment;
            if($data->acc == 0){
                $data->status = "Pengajuan Baru";
            }elseif($data->acc == 1){
                $data->status = "Proses Belanja";
            }elseif($data->acc == 2){
                $data->status = "Sedang Verifikasi Finance";
            }elseif($data->acc == 3){
                $data->status = "Selesai";
            }
            $data->aksi = '<a class="btn btn-sm btn-info" href="/pengajuan-purchase-detail/'.$data->id .'">Detail</a>';
        }
        return response()->json(['data' => $datas]);
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
        $inventory = Inventory::where('jenis','!=',9)->where('jenis','!=',10)->get();
        $tanggal = Carbon::now('Asia/Jakarta')->format('d-m-Y');
        
        return view('pengajuan_purchase.index', compact('kode', 'tanggal', 'inventory'));
    }

    public function getDataDetail($kode){
        $datas = DetailPengajuanPurchase::where('kode', $kode )->get();
        
        foreach($datas as $data){
            $data->nama = $data->inventory->nama;
            $data->tempat = $data->supplier->nama ." | ". $data->supplier->alamat;
            $data->subtotal = $data->sub_total;
            if($data->acc == 0){
                $data->status = "Baru";
            }elseif($data->acc == 1){
                $data->status = "Disetujui";
            }elseif($data->acc = 2){
                $data->status = "Ditolak";
            }
            $data->aksi = '<a class="btn btn-sm btn-danger" href="javascript:void(0);" onclick="hapus('.$data->id .')">Delete</a>';
        }
        return response()->json(['data' => $datas]);
    }

    public function simpan(Request $request)
    {
        $data = new DetailPengajuanPurchase();
        DB::beginTransaction();
        $success = false;
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
                $success = true;                
            } else {
                DB::rollback();
                $success = false;                
                
            }
        } catch (\Throwable $th) {
            DB::rollback();
            $success = false;                                
        }
        return response()->json(['success' => $success]);
    }

    public function ajukan(Request $request)
    {
        $data = new PengajuanPurchase();
        DB::beginTransaction();
        try {
            $data->kode = $request->kode;
            $data->tanggal = now();
            $totalItem = DetailPengajuanPurchase::where('kode',$request->kode)->count();
            $data->total_item = $totalItem;
            $data->total_payment = DetailPengajuanPurchase::where('kode', $request->kode )->sum('sub_total');;
            $data->acc = 0;
            $data->save();
            if ($data->save()) {
                DB::commit();
                $success = true;
            } else {
                DB::rollback();
                $success = false;                
            }
        } catch (\Throwable $th) {
            DB::rollback();
            $success = false;
        }
        return redirect('/pengajuan-purchase')->with('Save','Berhasil');
    }

    public function delete(Request $request)
    {
        $data = DetailPengajuanPurchase::where('id', $request->id)->first();
        if (!$data) {
            return 'false';
        }
        if ($data->delete()) {
            return 'true';

        }else{
            return 'false';
        }
    }

    public function detail($id){
        $data = PengajuanPurchase::find($id);
        $detail = DetailPengajuanPurchase::where('kode',$data->kode)->get();
        return view('pengajuan_purchase.detail',compact('data','detail'));
    }

    public function getdetailperif($kode){
        $datas = DetailPengajuanPurchase::where('kode', $kode )->get();
        
        foreach($datas as $data){
            $data->nama = $data->inventory->nama;
            $data->tempat = $data->supplier->nama ." | ". $data->supplier->alamat;
            $data->subtotal = $data->sub_total;
            if($data->acc == 0){
                $data->status = "Baru";
            }elseif($data->acc == 1){
                $data->status = "Disetujui";
            }elseif($data->acc = 2){
                $data->status = "Ditolak";
            }
            if(Auth::user()->role_id == 3){
                $data->aksi = '<a class="btn btn-sm btn-success" href="javascript:void(0);" onclick="acc('.$data->id .',1)">Terima</a>';
                $data->aksi .= '<a class="btn btn-sm btn-warning" href="javascript:void(0);" onclick="acc('.$data->id .',2)">Tolak</a>';
            }else{
                $data->aksi ="";
            }
        }
        return response()->json(['data' => $datas]);
    }

    public function acc(Request $request){
        $data = DetailPengajuanPurchase::find($request->id);
        if($data->acc != 0){
            if($request->status == 1){
                $purchase = PengajuanPurchase::where('kode',$data->kode)->first();
                $purchase->total_payment = $purchase->total_payment + $data->sub_total;
                $purchase->update(); 
            }
        }
        $data->acc = $request->status;
        if($request->status == 2){
            $purchase = PengajuanPurchase::where('kode',$data->kode)->first();
            $purchase->total_payment = $purchase->total_payment - $data->sub_total;
            $purchase->update(); 
        }
        $data->update();
        return true;
    }

    public function setujui(Request $request){
        $data = PengajuanPurchase::where('kode',$request->kode)->first();
        if(Auth::user()->role_id == 3 && $data->acc == 0){
            $data->acc = 1;
            if ($request->hasFile('bukti')) {
                $filename_bukti = "bukti_$request->kode." . $request->file('bukti')->extension();
                $request->file('bukti')->move('purchase/', $filename_bukti);
                $data->bukti = $filename_bukti;
            }
        }elseif(Auth::user()->role_id == 4 && $data->acc == 1){
            $data->acc = 2;
            if ($request->hasFile('kwitansi')) {
                dd($request->all());
                $filename_kwitansi = "kwitansi_$request->kode." . $request->file('kwitansi')->extension();
                $request->file('kwitansi')->move('purchase/', $filename_kwitansi);
                $data->kwitansi = $filename_kwitansi;
            }
        }elseif(Auth::user()->role_id == 3 && $data->acc == 2){
            $data->acc = 3;
        }
        $data->update();
        return redirect('/pengajuan-purchase')->with('Save','Berhasil');
                                
    }

}
