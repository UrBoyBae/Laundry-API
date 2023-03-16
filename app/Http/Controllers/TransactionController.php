<?php

namespace App\Http\Controllers;

use App\Http\Resources\nonRelationTransactionResource;
use App\Http\Resources\TransactionResource;
use App\Models\TransactionModel;
use Illuminate\Http\Request;

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
            return response()->json(['message' => 'Failed']);
        }

        return response()->json(['message' => 'Succeed']);
    }

    public function getDetailTransaction($id)
    {
        $data = TransactionModel::findOrFail($id);
        return new nonRelationTransactionResource($data);
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
            return response()->json(['message' => 'Failed']);
        }

        return response()->json(['message' => 'Succeed']);
    }

    public function deleteTransaction($id){
        $data = TransactionModel::findOrFail($id);
        $data->delete();
        if(!$data){
            return response()->json(['message'=>'Failed']);
        }

        return response()->json(['message'=>'Succeed']);
    }
}
