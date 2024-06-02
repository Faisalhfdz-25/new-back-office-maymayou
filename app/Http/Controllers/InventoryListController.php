<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\JenisKategori;
use App\Models\KelasProduk;
use App\Models\PenggunaanProduk;
use App\Models\Resep;
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
            $data->satuan_pengadaan = $request->satuan_pengadaan;
            $data->qty_min_pengadaan = $request->qty_min_pengadaan;
            $data->satuan_produksi = $request->satuan_produksi;
            $data->qty_min_stok = $request->qty_min_stok;
            $data->merk = $request->merk;
            $data->tempat = $request->supplier;
            $data->rumus_bagi = 1;
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
            $data->satuan_pengadaan = $request->satuan_pengadaan;
            $data->qty_min_pengadaan = $request->qty_min_pengadaan;
            $data->satuan_produksi = $request->satuan_produksi;
            $data->qty_min_stok = $request->qty_min_stok;
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

    public function resep($id)
    {
        $data = Inventory::find($id);
        $inventory = Inventory::all();
        $resep = Resep::where('id_produk',$id)->get();
        return view('inventorylist.resep',compact('data','resep','inventory'));
    }

    public function simpanresep(Request $request){
        $data = new Resep();
        $data->id_produk = $request->id_produk;
        $data->id_inventory = $request->id_inventory;

        $inventory = Inventory::find($request->id_inventory);
        $data->satuan_produksi = $inventory->satuan_produksi;
        $data->harga="";
        $data->qty = $request->qty;
        $data->save();
        return redirect()->back()->with('Save','Data Berhasil Disimpan');

    }

    public function hapusresep(Request $request)
    {
        $data = Resep::where('id', $request->id)->first();
        if (!$data) {
            return 'false';
        }
        if ($data->delete()) {
            return 'true';
        } else {
            return 'false';
        }
    }
}
