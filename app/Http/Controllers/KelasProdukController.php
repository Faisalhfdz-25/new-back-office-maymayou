<?php

namespace App\Http\Controllers;

use App\Models\KelasProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelasProdukController extends Controller
{
    public function index(){
        return view('kelasproduk.index');
    }

    public function getData(){
        $datas = KelasProduk::all();
        foreach($datas as $data){
            $data->nama = $data->nama;
            $data->keterangan = $data->keterangan;
            $data->aksi = '<a href="javascript:void(0);" class="btn btn-round mb-1 btn-warning text-charcoal" onclick="edit(' .$data->id. ')"><i class="ti-pencil-alt"></i>Edit</a>';
            $data->aksi .= '<a href="javascript:void(0);" class="btn btn-round mb-1 btn-danger text-charcoal" onclick="hapus(' .$data->id .')"><i class="ti-trash"></i>Delete</a>';
        }
        return response()->json(['data' => $datas]);
    }

    public function simpan(Request $request)
    {
        $data = new KelasProduk();        
        DB::beginTransaction();
        $success = false;
        try {
            $data->nama = $request->nama;
            $data->keterangan = $request->keterangan;
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
        $data = KelasProduk::where('id', $request->id)->first();
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
        $data = KelasProduk::find($request->id);
        if (!$data) {
            return false;
        }
        $data->nama = $data->nama;
        $data->keterangan = $data->keterangan;
        return $data;
    }

    public function update(Request $request)
    {
        $data = KelasProduk::find($request->id);       
        DB::beginTransaction();
        $success = false;
        try {
            $data->nama = $request->nama;
            $data->keterangan = $request->keterangan;
            if ($data->update()) {
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
}
