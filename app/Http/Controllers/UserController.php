<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data = User::all();
        return view('user.index', compact('data'));
    }

    public function store(Request $request)
    {
        $data = new User();
        DB::beginTransaction();
        try {
            $data->name = $request->name;
            $data->email = $request->email;
            $data->password = Hash::make($request->password);
            $data->role_id = $request->role_id;

            if ($data->save()) {
                DB::commit();
            } else {
                DB::rollback();
            }
        } catch (\Throwable $th) {
            DB::rollback();
        }

        return redirect('/user')->with('Save', 'Data Berhasil disimpan');
    }

    public function delete(Request $request)

    {
        $data = User::where('id', $request->id)->first();
        if (!$data) {
            return 'false';
        }

        if ($data->delete()) {
            return 'true';
        } else {
            return 'false';
        }
    }

    public function getDetail(Request $request)
    {
        $data = User::find($request->id);
        if (!$data) {
            return false;
        }
        return response()->json($data);
    }

    public function update(Request $request)
    {
        $data = User::find($request->id);
        DB::beginTransaction();
        try {
            $data->name = $request->name;
            $data->email = $request->email;
            if ($request->password) {
                $data->password = Hash::make($request->password);
            }
            $data->role_id = $request->role_id;
            if ($data->update()) {
                DB::commit();
            }else{
                DB::rollback();
            }
        } catch (\Throwable $th) {
            DB::rollback();
        }

        return redirect('/user')->with('Save', 'Data Berhasil disimpan');
    }
}
