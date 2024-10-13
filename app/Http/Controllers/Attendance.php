<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absen;

class Attendance extends Controller
{
    public function attendanceTrainer(Request $request)
    {
        Absen::create([
            'id_jadwal' => $request->id_jadwal,
            'email' => $request->email,
            'status' => 'Hadir',
        ]);

        return response()->json(['success' => 'Meeting added successfully!'], 200);
    }
}
