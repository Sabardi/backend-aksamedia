<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    //
    // public function index()
    // {
    //     $karyawan = Karyawan::with('division')->get();
    //     $GabungEmployees = $karyawan->map(function ($employee) {
    //         return [
    //             'id' => $employee->id,
    //             'image' => url('images/' . $employee->image),
    //             'name' => $employee->name,
    //             'phone' => $employee->phone,
    //             'division' => [
    //                 'id' => $employee->division->id,
    //                 'name' => $employee->division->name,
    //             ],
    //             'position' => $employee->division->name,
    //         ];
    //     });

    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'Data retrieved successfully',
    //         'data' => [
    //             'employees' => $GabungEmployees
    //         ]
    //     ], 200);
    // }

    public function index(Request $request)
    {
        // Ambil parameter filter dari permintaan
        $searchName = $request->input('name');
        $searchDivision = $request->input('devisi');

        // Mulai query dengan relasi 'division'
        $query = Karyawan::with('division');

        // Terapkan filter berdasarkan nama jika diberikan
        if ($searchName) {
            $query->where('name' ,$searchName );
        }

        // Terapkan filter berdasarkan divisi jika diberikan
        if ($searchDivision) {
            $query->where('division_id', $searchDivision);
        }

        // Ambil data karyawan setelah diterapkan filter
        $karyawan = $query->get();

        // Transformasi data karyawan
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
            'message' => 'sukses',
            'data' => [
                'employees' => $GabungEmployees
            ]
        ], 200);
    }

    public function store(Request $request){
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

    public function update(Request $request, $id){
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
