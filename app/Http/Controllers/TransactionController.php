<?php

namespace App\Http\Controllers;

use App\Http\Resources\nonRelationTransactionResource;
use App\Http\Resources\TransactionResource;
use App\Models\TransactionModel;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TransactionController extends Controller
{
    public function getTransaction()
    {
        $data = TransactionModel::all();
        return TransactionResource::collection($data->loadMissing('outlet:id,nama,alamat', 'member:id,nama,alamat', 'user:id,nama'));
    }

    public function addTransaction(Request $request)
    {
        $request->validate([
            'id_outlet' => 'required',
            'kode_invoice' => 'required',
            'id_member' => 'required',
            'tgl' => 'required',
            'batas_waktu' => 'required',
            'tgl_bayar' => 'required',
            'biaya_tambahan' => 'required',
            'diskon' => 'required',
            'pajak' => 'required',
            'status' => 'required',
            'dibayar' => 'required',
            'id_user' => 'required',
        ]);

        $data = TransactionModel::create([
            'id_outlet' => $request->id_outlet,
            'kode_invoice' => $request->kode_invoice,
            'id_member' => $request->id_member,
            'tgl' => $request->tgl,
            'batas_waktu' => $request->batas_waktu,
            'tgl_bayar' => $request->tgl_bayar,
            'biaya_tambahan' => $request->biaya_tambahan,
            'diskon' => $request->diskon,
            'pajak' => $request->pajak,
            'status' => $request->status,
            'dibayar' => $request->dibayar,
            'id_user' => $request->id_user,
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

    public function getDetailTransaction($id)
    {
        $data = TransactionModel::findOrFail($id);
        return new TransactionResource($data->loadMissing('outlet:id,nama,alamat', 'member:id,nama,alamat', 'user:id,nama'));
    }

    public function editTransaction(Request $request, $id)
    {
        $request->validate([
            'id_outlet' => 'required',
            'kode_invoice' => 'required',
            'id_member' => 'required',
            'tgl' => 'required',
            'batas_waktu' => 'required',
            'tgl_bayar' => 'required',
            'biaya_tambahan' => 'required',
            'diskon' => 'required',
            'pajak' => 'required',
            'status' => 'required',
            'dibayar' => 'required',
            'id_user' => 'required',
        ]);

        $data = TransactionModel::findOrFail($id);
        $data->update([
            'id_outlet' => $request->id_outlet,
            'kode_invoice' => $request->kode_invoice,
            'id_member' => $request->id_member,
            'tgl' => $request->tgl,
            'batas_waktu' => $request->batas_waktu,
            'tgl_bayar' => $request->tgl_bayar,
            'biaya_tambahan' => $request->biaya_tambahan,
            'diskon' => $request->diskon,
            'pajak' => $request->pajak,
            'status' => $request->status,
            'dibayar' => $request->dibayar,
            'id_user' => $request->id_user,
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

    public function deleteTransaction($id){
        $data = TransactionModel::findOrFail($id);
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
