<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absen;
use App\Models\Training;
use App\Models\JadwalTraining;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\LaravelIgnition\Http\Requests\UpdateConfigRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Attendance extends Controller
{
    public function attendanceTrainer(Request $request, $id)
    {
        $jadwal = JadwalTraining::find($id);
        $training = Training::find($jadwal->id_training);
        $trainerAbsent = Absen::where('id_jadwal', $id)->where('email', $training->email_trainer)->first();
        $now = Carbon::now()->setTimezone('Asia/Jakarta');
        $meet = JadwalTraining::find($id);
        $meet->pertemuan_mulai = $now;
        $meet->save();

        if (
            $now >= $meet->waktu_mulai && $now <= $meet->waktu_selesai &&
            (Auth::user()->email ?? 'null') == ($training->email_trainer ?? 'null') &&
            ($trainerAbsent ?? 'null' == 'null')
        ) {
            Absen::create([
                'id_jadwal' => $id,
                'email' => $request->email,
                'status' => 'Hadir',
                'updated_at' => $now
            ]);
            return response()->json(['success' => 'Success Absence!'], 200);
        }
        return response()->json(['error' => 'Failed Absence!'], 404);
    }

    public function attendancePeserta(Request $request)
{

    $request->validate([
        'id_jadwal' => 'required|integer',
        'email' => 'required|email',
    ]);

    $id_jadwal = $request->id_jadwal;
    $email = $request->email;

    try {
        DB::table('absen')->insert([
            'id_jadwal' => $id_jadwal,
            'email' => $email,
            'status' => 'Hadir',
            'created_at' => now()->setTimezone('Asia/Jakarta'),
            'updated_at' => now()->setTimezone('Asia/Jakarta'),
        ]);
        return response()->json(['success' => true, 'message' => 'Attendance marked successfully.']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Failed to mark attendance. You already take attendancey', 'error' => $e->getMessage()]);
    }
}

}
