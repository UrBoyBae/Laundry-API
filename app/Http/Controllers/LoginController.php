<?php

namespace App\Http\Controllers;

use App\Http\Resources\LoginResource;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $data = UserModel::where('username', $request->username)->first();
        if (!$data) {
            return response()->json([
                'status' => Response::HTTP_BAD_REQUEST,
                'message' => 'Username Yang Dimasukkan Salah',
            ]);
        } else {
            if (!Hash::check($request->password, $data->password)) {
                return response()->json([
                    'status' => Response::HTTP_BAD_REQUEST,
                    'message' => 'Password Yang Dimasukkan Salah',
                ]);
            }
        }

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'success',
            'data' => new LoginResource($data),
        ]);
    }
}
