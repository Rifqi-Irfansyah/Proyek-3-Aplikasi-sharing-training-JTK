<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absen;
use Illuminate\Support\Facades\DB;


class Attendance extends Controller
{
    public function attendanceTrainer(Request $request)
    {
        DB::table('absen')
        ->where('id_jadwal', $request->id_jadwal)
        ->where('email', $request->email)
        ->update(['status' => 'Hadir', 'updated_at' => now()->setTimezone('Asia/Jakarta')]);    
        return response()->json(['success' => 'Meeting added successfully!'], 200);
    }
}
