<?php

namespace App\Http\Controllers;

use App\Http\Resources\detailMemberResource;
use App\Http\Resources\MemberResource;
use App\Models\MemberModel;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MemberController extends Controller
{
    public function getMember() {
        $data = MemberModel::all();
        // return response()->json($data);
        return MemberResource::collection($data);
    }

    public function addMember(Request $request) {
        $request -> validate([
            'nama' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'tlp' => 'required',
        ]);

        $data = MemberModel::create($request->all());
        if(!$data){
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

    public function getDetailMember($id) {
        $data = MemberModel::findOrFail($id);
        return new MemberResource($data);
    }

    public function editMember(Request $request, $id) {
        $request -> validate([
            'nama' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'tlp' => 'required',
        ]); 

        $data = MemberModel::findOrFail($id);
        $data->update($request->all());
        
        if(!$data){
            return response()->json([
                'status' => Response::HTTP_BAD_REQUEST,
                'message'=>'Gagal Mengubah Data',
            ]);
        }

        return response()->json([
            'status' => Response::HTTP_ACCEPTED,
            'message'=>'Berhasil Mengubah Data',
        ]);
    }

    public function deleteMember($id) {
        $data = MemberModel::findOrFail($id);
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
