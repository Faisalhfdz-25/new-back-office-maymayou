<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('user.index',compact('roles'));
    }

    public function getData(){
        $datas = User::all();
        foreach($datas as $data){
            $data->name = $data->name;
            $data->email = $data->email;
            $data->role_id = $data->role->nama;
            $data->aksi = '<a href="javascript:void(0);" class="btn btn-round mb-1 btn-warning text-charcoal" onclick="edit(' .$data->id. ')"><i class="ti-pencil-alt"></i>Edit</a>';
            $data->aksi .= '<a href="javascript:void(0);" class="btn btn-round mb-1 btn-danger text-charcoal" onclick="hapus(' .$data->id .')"><i class="ti-trash"></i>Delete</a>';
        }
        return response()->json(['data' => $datas]);
    }

    public function store(Request $request)
    {
        $data = new User();
        DB::beginTransaction();
        $success = false;
        try {
            $data->name = $request->name;
            $data->email = $request->email;
            $data->password = Hash::make($request->password);
            $data->role_id = $request->role_id;

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
        $success = false;
        try {
            $data->name = $request->name;
            $data->email = $request->email;
            if ($request->password) {
                $data->password = Hash::make($request->password);
            }
            $data->role_id = $request->role_id;
            if ($data->update()) {
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
}
