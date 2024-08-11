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
}
