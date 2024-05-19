<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\JenisKategori;
use App\Models\KelasProduk;
use App\Models\PenggunaanProduk;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryListController extends Controller
{
    public function index(){
        $data = Inventory::all();
        $kelas = KelasProduk::orderBy('id','ASC')->get();
        $penggunaan = PenggunaanProduk::orderBy('id','ASC')->get();
        $jenis = JenisKategori::orderBy('id','ASC')->get();
        $tempat = Supplier::orderBy('id','ASC')->get();
        return view('inventorylist.index',compact('data','kelas','penggunaan','jenis','tempat'));
    }

    public function simpan(Request $request)
    {
        $data = new Inventory();        
        DB::beginTransaction();
        try {
            $data->kode = $request->kode;
            $data->nama = $request->nama;
            $data->jenis = $request->jenis;
            $data->penggunaan = $request->penggunaan;
            $data->kelas = $request->kelas;
            $data->satuan = $request->satuan;
            $data->qty_min = $request->qty;
            $data->merk = $request->merk;
            $data->tempat = $request->supplier;
            if($request->is_produksi){
                $data->is_produksi = true;
            }else{
                $data->is_produksi = false;
            }
            
            if($request->is_toko){
                $data->is_toko = true;
            }else{
                $data->is_toko = false;
            }
            
            if($request->is_frozen){
                $data->is_frozen = true;
            }else{
                $data->is_frozen = false;
            }
            if ($data->save()) {
                DB::commit();
            } else {
                DB::rollback();
            }
        } catch (\Throwable $th) {
            DB::rollback();
        }
        return redirect('/inventory-list')->with('Save','Data Berhasil Disimpan');
    }

    public function hapus(Request $request)
    {
        $data = Inventory::where('id', $request->id)->first();
        if (!$data) {
            return 'false';
        }
        if ($data->delete()) {
            return 'true';
        } else {
            return 'false';
        }
    }

    public function editview($id)
    {
        $data = Inventory::find($id);
        $kelas = KelasProduk::orderBy('id','ASC')->get();
        $penggunaan = PenggunaanProduk::orderBy('id','ASC')->get();
        $jenis = JenisKategori::orderBy('id','ASC')->get();
        $tempat = Supplier::orderBy('id','ASC')->get();
        return view('inventorylist.editview',compact('data','kelas','penggunaan','jenis','tempat'));
    }

    public function update(Request $request)
    {
        $data = Inventory::find($request->id);      
        
            $data->kode = $request->kode;
            $data->nama = $request->nama;
            $data->jenis = $request->jenis;
            $data->penggunaan = $request->penggunaan;
            $data->kelas = $request->kelas;
            $data->satuan = $request->satuan;
            $data->qty_min = $request->qty;
            $data->merk = $request->merk;
            $data->tempat = $request->supplier;

            if($request->is_produksi){
                $data->is_produksi = true;
            }else{
                $data->is_produksi = false;
            }
            
            if($request->is_toko){
                $data->is_toko = true;
            }else{
                $data->is_toko = false;
            }
            
            if($request->is_frozen){
                $data->is_frozen = true;
            }else{
                $data->is_frozen = false;
            }
            $data->update();
        return redirect('/inventory-list')->with('Save','Data Berhasil Disimpan');
    }
}
