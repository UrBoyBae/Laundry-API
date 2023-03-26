<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function getUser()
    {
        $data = UserModel::all();
        return UserResource::collection($data->loadMissing(['outlet:id,nama,alamat']));
    }

    public function addUser(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required',
            'id_outlet' => 'required',
            'role' => 'required',
        ]);
        $passwordHashed = Hash::make($request->password);

        $data = UserModel::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => $passwordHashed,
            'id_outlet' => $request->id_outlet,
            'role' => $request->role,
        ]);

        if (!$data) {
            return response()->json([
                'status' => Response::HTTP_BAD_REQUEST,
                'message'=>'Gagal Menambahkan Data',
            ]);
        }

        return response()->json([
            'status' => Response::HTTP_CREATED,
            'message'=>'Berhasil Menambahkan Data',
        ]);
    }

    public function getDetailUser($id)
    {
        $data = UserModel::findOrFail($id);
        return new UserResource($data);
    }

    public function editUser(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'password',
            'id_outlet' => 'required',
            'role' => 'required',
        ]);

        $data = UserModel::findOrFail($id);

        if (($request->password != "") || ($request->password != null)) {
            $passwordHashed = Hash::make($request->password);
            $data->update([
                'nama' => $request->nama,
                'username' => $request->username,
                'password' => $passwordHashed,
                'id_outlet' => $request->id_outlet,
                'role' => $request->role,
            ]);
            return response()->json([
                'status' => Response::HTTP_ACCEPTED,
                'message'=>'Berhasil Mengubah Data',
            ]);
        } else {
            $data->update([
                'nama' => $request->nama,
                'username' => $request->username,
                'id_outlet' => $request->id_outlet,
                'role' => $request->role,
            ]);
            return response()->json([
                'status' => Response::HTTP_ACCEPTED,
                'message'=>'Berhasil Mengubah Data',
            ]);
        }
    }

    public function deleteUser($id){
        $data = UserModel::findOrFail($id);
        $data->delete();
        if(!$data){
            return response()->json([
                'status' => Response::HTTP_BAD_REQUEST,
                'message'=>'Gagal Menghapus Data',
            ]);
        }

        return response()->json([
            'status' => Response::HTTP_OK,
            'message'=>'Berhasil Menghapus Data',
        ]);
    }
}
