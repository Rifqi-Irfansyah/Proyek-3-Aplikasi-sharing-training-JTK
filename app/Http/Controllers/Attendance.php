<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absen;
use App\Models\JadwalTraining;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\LaravelIgnition\Http\Requests\UpdateConfigRequest;
use Carbon\Carbon;

class Attendance extends Controller
{
    public function attendanceTrainer(Request $request, $id)
    {
        $now = Carbon::now()->setTimezone('Asia/Jakarta');
        $meet = JadwalTraining::find($id);
        $meet->pertemuan_mulai = $now;
        $meet->save();

        DB::table('absen')
            ->where('id_jadwal', $id)
            ->where('email', $request->email)
            ->update(['status' => 'Hadir', 'updated_at' => now()->setTimezone('Asia/Jakarta')]);
        return response()->json(['success' => 'Meeting added successfully!'], 200);
    }

    public function attendancePeserta(Request $request)
    {
        $request->validate([
            'id_jadwal' => 'required|integer',
            'email' => 'required|email',
        ]);

        $id_jadwal = $request->id_jadwal;
        $email = $request->email;

        if ($request->has('id_jadwal') && $request->has('email')) {
            DB::table('absen')
                ->where('id_jadwal', $id_jadwal)
                ->where('email', $email)
                ->update(['status' => 'Hadir', 'updated_at' => now()->setTimezone('Asia/Jakarta')]);

            return response()->json(['success' => true, 'message' => 'Attendance marked successfully.']);
        }
        return response()->json(['success' => false, 'message' => 'Failed to mark attendance.']);
    }
}
