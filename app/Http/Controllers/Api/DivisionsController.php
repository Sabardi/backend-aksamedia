<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Divisions;

class DivisionsController extends Controller
{

    public function index(Request $request){

        $name = $request->input('name');

        if (empty($name)) {
            return response()->json([
                'message' => 'Keyword pencarian tidak boleh kosong',
                'data' => []
            ], 400);
        }

        $search = Divisions::where('name',$name)
        ->orWhere('name', 'like', "%{$name}%")->get();

        return response()->json([
            "status" => "success",
            "message" => "sukses",
            "data" => $search
        ], 200);
    }
}
