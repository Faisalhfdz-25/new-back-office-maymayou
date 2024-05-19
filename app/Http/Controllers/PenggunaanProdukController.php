<?php

namespace App\Http\Controllers;

use App\Models\PenggunaanProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenggunaanProdukController extends Controller
{
    public function index(){
        $data = PenggunaanProduk::all();
        return view('penggunaanproduk.index',compact('data'));
    }

    public function simpan(Request $request)
    {
        $data = new PenggunaanProduk();        
        DB::beginTransaction();
        try {
            $data->nama = $request->nama;
            $data->keterangan = $request->keterangan;
            if ($data->save()) {
                DB::commit();
            } else {
                DB::rollback();
            }
        } catch (\Throwable $th) {
            DB::rollback();
        }
        return redirect('/penggunaan-produk')->with('Save','Data Berhasil Disimpan');
    }

    public function hapus(Request $request)
    {
        $data = PenggunaanProduk::where('id', $request->id)->first();
        if (!$data) {
            return 'false';
        }
        if ($data->delete()) {
            return 'true';
        } else {
            return 'false';
        }
    }

    public function getdetail(Request $request)
    {
        $data = PenggunaanProduk::find($request->id);
        if (!$data) {
            return false;
        }
        $data->nama = $data->nama;
        $data->keterangan = $data->keterangan;
        return $data;
    }

    public function update(Request $request)
    {
        $data = PenggunaanProduk::find($request->id);       
        DB::beginTransaction();
        try {
            $data->nama = $request->nama;
            $data->keterangan = $request->keterangan;
            if ($data->update()) {
                DB::commit();
            } else {
                DB::rollback();
            }
        } catch (\Throwable $th) {
            DB::rollback();
        }
        return redirect('/penggunaan-produk')->with('Save','Data Berhasil Disimpan');
    }
}
