<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    //
    public function index()
    {
        $karyawan = Karyawan::with('division')->get();
        $GabungEmployees = $karyawan->map(function ($employee) {
            return [
                'id' => $employee->id,
                'image' => url('images/' . $employee->image),
                'name' => $employee->name,
                'phone' => $employee->phone,
                'division' => [
                    'id' => $employee->division->id,
                    'name' => $employee->division->name,
                ],
                'position' => $employee->division->name,
            ];
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Data retrieved successfully',
            'data' => [
                'employees' => $GabungEmployees
            ]
        ], 200);
    }

    public function search(Request $request)
{
    $name = $request->input('name');

    if (empty($name)) {
        return response()->json([
            'status' => 'error',
            'message' => 'Keyword pencarian tidak boleh kosong',
            'data' => [
                'employees' => []
            ],
            'pagination' => []
        ], 400);
    }

    // Use pagination
    $employees = Karyawan::where('name', $name)
        ->orWhere('name', 'like', "%{$name}%")
        ->with('division')
        ->paginate(10);

    // Transform 
    $transformedEmployees = $employees->map(function ($employee) {
        return [
            'id' => $employee->id,
            'image' => url('images/' . $employee->image),
            'name' => $employee->name,
            'phone' => $employee->phone,
            'division' => [
                'id' => $employee->division->id,
                'name' => $employee->division->name,
            ],
            'position' => $employee->division->name,
        ];
    });

    return response()->json([
        'status' => 'success',
        'message' => 'sukses',
        'data' => [
            'employees' => $transformedEmployees
        ],
        'pagination' => [
            'current_page' => $employees->currentPage(),
            'last_page' => $employees->lastPage(),
            'per_page' => $employees->perPage(),
            'total' => $employees->total(),
            'from' => $employees->firstItem(),
            'to' => $employees->lastItem(),
        ],
    ], 200);
}


    public function store(Request $request)
    {
        $request->validate([
            "image" => "required",
            "name" => "required",
            "phone" => "required",
            "division_id" => "required",
            "position" => "required",
        ]);

        Karyawan::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'sukses'
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "image" => "required",
            "name" => "required",
            "phone" => "required",
            "division_id" => "required",
            "position" => "required",
        ]);

        $karyawan = Karyawan::find($id);

        if (is_null($karyawan)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan',
            ], 404);
        }
        $karyawan->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'sukses'
        ], 200);
    }

    public function destroy($id)
    {
        $karyawan = Karyawan::find($id);
        if (is_null($karyawan)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        $karyawan->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil dihapus'
        ], 204);
    }
}
