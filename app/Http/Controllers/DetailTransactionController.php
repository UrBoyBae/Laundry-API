<?php

namespace App\Http\Controllers;

use App\Http\Resources\DetailTransactionResource;
use App\Models\DetailTransactionModel;
use Illuminate\Http\Request;

class DetailTransactionController extends Controller
{
    public function getDetail($id)
    {
        $data = DetailTransactionModel::where('id_transaksi', $id)->get();
        return response()->json(['data'=>$data]);
    }
}
