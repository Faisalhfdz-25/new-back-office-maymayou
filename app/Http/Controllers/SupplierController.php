<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public function index(){
        return view('supplier.index');
    }

    public function getData(){
        $datas = Supplier::all();
        foreach($datas as $data){
            $data->nama = $data->nama;
            $data->alamat = $data->alamat;
            $data->aksi = '<a href="javascript:void(0);" class="btn btn-round mb-1 btn-warning text-charcoal" onclick="edit(' .$data->id. ')"><i class="ti-pencil-alt"></i>Edit</a>';
            $data->aksi .= '<a href="javascript:void(0);" class="btn btn-round mb-1 btn-danger text-charcoal" onclick="hapus(' .$data->id .')"><i class="ti-trash"></i>Delete</a>';
        }
        return response()->json(['data' => $datas]);
    }

    public function simpan(Request $request)
    {
        $data = new Supplier();        
        DB::beginTransaction();
        $success = false;
        try {
            $data->nama = $request->nama;
            $data->alamat = $request->alamat;
            if ($data->save()) {
                $success = true;
                DB::commit();
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
        $data = Supplier::where('id', $request->id)->first();
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
        $data = Supplier::find($request->id);
        if (!$data) {
            return false;
        }
        $data->nama = $data->nama;
        $data->alamat = $data->alamat;
        return $data;
    }

    public function update(Request $request)
    {
        $data = Supplier::find($request->id);       
        DB::beginTransaction();
        $success = false;
        try {
            $data->nama = $request->nama;
            $data->alamat = $request->alamat;
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
