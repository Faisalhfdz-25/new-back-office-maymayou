<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public function index(){
        $data = Supplier::all();
        return view('supplier.index',compact('data'));
    }

    public function simpan(Request $request)
    {
        $data = new Supplier();        
        DB::beginTransaction();
        try {
            $data->nama = $request->nama;
            $data->alamat = $request->alamat;
            if ($data->save()) {
                DB::commit();
            } else {
                DB::rollback();
            }
        } catch (\Throwable $th) {
            DB::rollback();
        }
        return redirect('/supplier')->with('Save','Data Berhasil Disimpan');
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
        try {
            $data->nama = $request->nama;
            $data->alamat = $request->alamat;
            if ($data->update()) {
                DB::commit();
            } else {
                DB::rollback();
            }
        } catch (\Throwable $th) {
            DB::rollback();
        }
        return redirect('/supplier')->with('Save','Data Berhasil Disimpan');
    }
}
