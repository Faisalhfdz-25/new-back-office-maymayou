<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TokoController extends Controller
{
    public function index()
    {
        return view('toko.index');
    }

    public function getData(){
        $datas = Toko::all();
        foreach($datas as $data){
            $data->nama = $data->nama;
            $data->alamat = $data->alamat;
            $data->aksi = '<a href="javascript:void(0);" class="btn btn-round mb-1 btn-warning text-charcoal" onclick="edit(' .$data->id. ')"><i class="ti-pencil-alt"></i>Edit</a>';
            $data->aksi .= '<a href="javascript:void(0);" class="btn btn-round mb-1 btn-danger text-charcoal" onclick="hapus(' .$data->id .')"><i class="ti-trash"></i>Delete</a>';
        }
        return response()->json(['data' => $datas]);
    }

    public function store(Request $request)
    {
        $data = new Toko();
        DB::beginTransaction();
        $success = false;
        try {
            $data->nama = $request->nama;
            $data->alamat = $request->alamat;

            if ($data->save()) {
                DB::commit();
                $success = true;

            }else{
                DB::rollback();
            }
        } catch (\Throwable $th) {
            DB::rollback();
        }
        return response()->json(['success' => $success]);
    }

    public function delete(Request $request)
    {
        $data = Toko::where('id', $request->id)->first();
        if (!$data) {
            return 'false';
        }
        if ($data->delete()) {
            return 'true';

        }else{
            return 'false';
        }
    }

    public function getDetail(Request $request)
    {
        $data = Toko::find($request->id);
        if (!$data) {
            return false;
        }
        $data->nama = $data->nama;
        $data->alamat = $data->alamat;
        return $data;
    }

    public function update(Request $request)
    {
        $data = Toko::find($request->id);
        DB::beginTransaction();
        $success = false;
        try {
            $data->nama = $request->nama;
            $data->alamat = $request->alamat;

            if ($data->update()) {
                $success = true;
                DB::commit();
            }else{
                DB::rollback();
            }
        } catch (\Throwable $th) {
            DB::rollback();
        }
        return response()->json(['success' => $success]);
    }
}
