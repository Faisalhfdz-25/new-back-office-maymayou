<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TokoController extends Controller
{
    public function index()
    {
        $data = Toko::all();
        return view('toko.index', compact('data'));

    }

    public function store(Request $request)
    {
        $data = new Toko();
        DB::beginTransaction();
        try {
            $data->nama = $request->nama;
            $data->alamat = $request->alamat;

            if ($data->save()) {
                DB::commit();
            }else{
                DB::rollback();
            }
        } catch (\Throwable $th) {
            DB::rollback();
        }

        return redirect('/toko')->with('Save', 'Data Berhasil Disimpan');
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
        try {
            $data->nama = $request->nama;
            $data->alamat = $request->alamat;

            if ($data->update()) {
                DB::commit();
            }else{
                DB::rollback();
            }
        } catch (\Throwable $th) {
            DB::rollback();
        }

        return redirect('/toko')->with('Save', 'Data Berhasil Disimpan');
    }
}
