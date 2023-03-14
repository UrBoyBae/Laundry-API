<?php

namespace App\Http\Controllers;

use App\Models\MemberModel;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index(){
        $data = MemberModel::all();
        return response()->json(['data' => $data]);
    }
}
