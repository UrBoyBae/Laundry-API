<?php

namespace App\Http\Controllers;

use App\Http\Resources\OutletResource;
use App\Models\OutletModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Nette\Utils\Json;

class OutletController extends Controller
{
    public function getOutlet() {
        $data = OutletModel::all();
        return OutletResource::collection($data);
    }

    public function addOutlet(Request $request) {
        $request -> validate([
            'nama' => 'required',
            'alamat' => 'required',
            'tlp' => 'required',
        ]);

        $data = OutletModel::create($request->all());
        if(!$data){
            return response()->json(['message'=>'Failed']);
        }

        return response()->json(['message'=>'Succeed']);
    }

    public function getDetailOutlet($id) {
        $data = OutletModel::findOrFail($id);
        return new OutletResource($data);
    }

    public function editOutlet(Request $request, $id) {
        $request -> validate([
            'nama' => 'required',
            'alamat' => 'required',
            'tlp' => 'required',
        ]); 

        $data = OutletModel::findOrFail($id);
        $data->update($request->all());
        
        if(!$data){
            return response()->json(['message'=>'Failed']);
        }

        return response()->json(['message'=>'Succeed']);
    }

    public function deleteOutlet($id) {
        $data = OutletModel::findOrFail($id);
        $data->delete();
        
        if(!$data){
            return response()->json(['message'=>'Failed']);
        }

        return response()->json(['message'=>'Succeed']);
    }
}
