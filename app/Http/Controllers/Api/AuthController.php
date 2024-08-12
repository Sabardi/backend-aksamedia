<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

    public function login(Request $request)
    {
        $input = [
            "username" => $request->username,
            "password" => $request->password,

        ];

        $user = User::where("username", $input["username"])->first();
        if (Auth::attempt($input)){
            $token = $user->createToken("token")->plainTextToken;
            return response()->json([
                "status" => "success",
                "message" => "success login",
                "data" =>[
                    "token" => $token,
                    "admin" => $user
                ]
            ],200);
        }else{
            return response()->json([
                "code" => 401,
                "status" => "error",
                "message" => "login filed",
            ]);
        }
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        // hapus tokent nya
        $user->tokens()->delete();

        return response()->json([
            "status" => "success",
            "message" => "Successfully logout",
        ], 200);
    }
}
