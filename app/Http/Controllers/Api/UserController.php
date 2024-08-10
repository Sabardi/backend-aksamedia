<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function index(){
        $user = User::all();
        return response()->json(
            [
                'data' =>$user
            ]
            );
    }
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
}
