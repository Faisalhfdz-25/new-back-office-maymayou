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
        $kelas = KelasProduk::orderBy('id','ASC')->get();
        $penggunaan = PenggunaanProduk::orderBy('id','ASC')->get();
        $jenis = JenisKategori::orderBy('id','ASC')->get();
        $tempat = Supplier::orderBy('id','ASC')->get();
        return view('inventorylist.index',compact('kelas','penggunaan','jenis','tempat'));
    }

    public function getData(){
        $datas = Inventory::all();
        foreach($datas as $data){
            $data->kode = $data->kode;
            $data->nama = $data->nama;
            $data->merk = $data->harga;
            $data->tempat = $data->supplier->nama." - ".$data->supplier->alamat;
            $data->harga = $data->harga;
            $data->penyaluran = "";
            if($data->is_produksi == 1){
                $data->penyaluran .= "<a class='btn btn-sm btn-outline-grape btn-round' href='javascript:void(0);'>Produksi</a>";
            }
            if($data->is_toko == 1){
                $data->penyaluran .= "<a class='btn btn-sm btn-outline-lemon btn-round' href='javascript:void(0);'>Toko</a>";
            }
            if($data->is_frozen == 1){
                $data->penyaluran .= "<a class='btn btn-sm btn-outline-azure btn-round' href='javascript:void(0);'>Frozen</a>";
            }
            $data->aksi = '<a href="/inventory-list/editview/'.$data->id.'" class="btn btn-round mb-1 btn-warning text-charcoal"><i class="ti-pencil-alt"></i></a>';
            if($data->jenis == 9 || $data->jenis == 10){
                $data->aksi .= '<a href="/inventory-list/resep/'.$data->id.'" class="btn btn-round mb-1 btn-info text-charcoal"><i class="ti-menu"></i></a>';
                $data->jenis = $data->jeniskategori->nama." | " .$data->penggunaanproduk->nama." | ".$data->kelasproduk->nama;
            }else{
                $data->jenis = $data->jeniskategori->nama." | " .$data->penggunaanproduk->nama." | ".$data->kelasproduk->nama;
            }
            $data->aksi .= '<a href="javascript:void(0);" class="btn btn-round mb-1 btn-danger text-charcoal" onclick="hapus(' .$data->id .')"><i class="ti-trash"></i></a>';

        }
        return response()->json(['data' => $datas]);

    }

    public function simpan(Request $request)
    {
        $data = new Inventory();        
        DB::beginTransaction();
        $success = false;
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
            $data->harga = $request->harga;
            $data->tempat = $request->supplier;
            $data->rumus_bagi = 1;
            if($request->rumus_bagi){
                $data->rumus_bagi = $request->rumus_bagi;
            }
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
                $success = true;
            } else {
                DB::rollback();
            }
        } catch (\Throwable $th) {
            DB::rollback();
        }
        return response()->json(['success' => $success]);
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
            $data->harga = $request->harga;
            $data->rumus_bagi = $request->rumus_bagi;

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
        if($data->jenis == 10){
            $inventory = Inventory::where('is_toko',1)->get();
        }else{
            $inventory = Inventory::where('is_produksi',1)->get();
        }
        return view('inventorylist.resep',compact('data','inventory'));
    }
        
    public function getDataResep($id){
        $reseps = Resep::where('id_produk',$id)->get();
        foreach($reseps as $resep){
            $resep->nama = $resep->inventory->nama;
            $resep->satuan = $resep->satuan_produksi;
            $resep->qty = $resep->qty;
            $harga = $resep->inventory->harga / $resep->inventory->qty_min_stok;
            $resep->harga = $resep->qty * $harga;
            $resep->aksi = '<a class="btn btn-sm btn-danger" href="javascript:void(0);" onclick="hapus('.$resep->id.')">Delete</a>';
        }
        return response()->json(['data' => $reseps]);
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
        $success = true;
        return response()->json(['success' => $success]);
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
