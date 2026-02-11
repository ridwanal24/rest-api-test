<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        return response()->json([
            'message' => 'success',
            'data' => User::all()
        ]);
    }

    public function get($id){
        $user = User::find($id);
        if(!$user){
            return response()->json([
                'message' => 'Not Found'
            ], 404);
        }

        return response()->json([
            'message' => 'success',
            'data' => $user 
        ]);
    }
    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6'
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password'])
        ]);

        return response()->json([
            'message' => 'User created',
        ], 201);
    }
    public function update($id){
        $validatedData = request()->validate([
            'email' => 'sometimes|nullable|string|email|max:255',
            'name' => 'sometimes|nullable|string|max:255',
            'password' => 'sometimes|nullable|string|min:6'
        ]);

        $user = User::find($id);
        if(!$user){
            return response()->json([
                'message' => 'User Not Found'
            ], 404);
        }

        if(isset($validatedData['email'])){
            $user->email = $validatedData['email'];
        }
        if(isset($validatedData['name'])){
            $user->name = $validatedData['name'];
        }
        if(isset($validatedData['password'])){
            $user->password = Hash::make($validatedData['password']);
        }

        $user->save();

        return response()->json([
           'message' => 'success',
        ], 200);
    }
    public function delete($id){
        $user = User::find($id);
        if(!$user){
            return response()->json([
                'message' => 'User Not Found'
            ], 404);
        }

        if($user->delete()){
            return response()->json([
                'message' => 'User deleted'
            ], 200);
        } else {
            return response()->json([
                'message' => 'User not deleted'
            ], 500);
        }
    }
}
