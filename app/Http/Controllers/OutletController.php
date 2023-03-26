<?php

namespace App\Http\Controllers;

use App\Http\Resources\OutletResource;
use App\Models\OutletModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Nette\Utils\Json;
use Symfony\Component\HttpFoundation\Response;

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

    public function deleteOutlet($id) {
        $data = OutletModel::findOrFail($id);
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
