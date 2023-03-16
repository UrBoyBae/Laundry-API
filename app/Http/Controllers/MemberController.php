<?php

namespace App\Http\Controllers;

use App\Http\Resources\detailMemberResource;
use App\Http\Resources\MemberResource;
use App\Models\MemberModel;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function getMember() {
        $data = MemberModel::all();
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
            return response()->json(['message'=>'Failed']);
        }

        return response()->json(['message'=>'Succeed']);
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
            return response()->json(['message'=>'Failed']);
        }

        return response()->json(['message'=>'Succeed']);
    }

    public function deleteMember($id) {
        $data = MemberModel::findOrFail($id);
        $data->delete();
        
        if(!$data){
            return response()->json(['message'=>'Failed']);
        }

        return response()->json(['message'=>'Succeed']);
    }
}
