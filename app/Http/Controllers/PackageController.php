<?php

namespace App\Http\Controllers;

use App\Http\Resources\nonRelationPackageResource;
use App\Http\Resources\PackageResource;
use App\Models\PackageModel;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PackageController extends Controller
{
    public function getPackage()
    {
        $data = PackageModel::all();
        return PackageResource::collection($data->loadMissing(['outlet:id,nama,alamat']));
    }

    public function addPackage(Request $request)
    {
        $request->validate([
            'id_outlet' => 'required',
            'jenis' => 'required',
            'nama_paket' => 'required',
            'harga' => 'required',
        ]);

        $data = PackageModel::create([
            'id_outlet' => $request->id_outlet,
            'jenis' => $request->jenis,
            'nama_paket' => $request->nama_paket,
            'harga' => $request->harga,
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

    public function getDetailPackage($id)
    {
        $data = PackageModel::findOrFail($id);
        return new nonRelationPackageResource($data);
    }

    public function editPackage(Request $request, $id)
    {
        $request->validate([
            'id_outlet' => 'required',
            'jenis' => 'required',
            'nama_paket' => 'required',
            'harga' => 'required',
        ]);

        $data = PackageModel::findOrFail($id);
        $data->update([
            'id_outlet' => $request->id_outlet,
            'jenis' => $request->jenis,
            'nama_paket' => $request->nama_paket,
            'harga' => $request->harga,
        ]);
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

    public function deletePackage($id){
        $data = PackageModel::findOrFail($id);
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
