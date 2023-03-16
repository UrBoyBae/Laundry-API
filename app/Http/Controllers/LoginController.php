<?php

namespace App\Http\Controllers;

use App\Http\Resources\LoginResource;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(Request $request) {
        $request -> validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        
        $data = UserModel::where('username', $request -> username)->first();
        
        if(!$data || !Hash::check($request->password, $data->password)){
            return response()->json(['message' => 'Username atau Password Salah']);
        }

        return new LoginResource($data);
    }
}
