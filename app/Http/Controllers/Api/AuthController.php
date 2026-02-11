<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use OpenApi\Attributes as OA;


class AuthController extends Controller
{

    public function login (Request $request) {

        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = [
            'email' => $validatedData['email'],
            'password' => $validatedData['password']
        ];

        $token = Auth()->guard('api')->attempt($credentials);

        if(!$token) {
            return response()->json([
                'error' => 'Unauthorized'   
            ], 401);
        }

        return response()->json([
            'message'=>'success',
            'token' => $token
        ]);

    }


}
