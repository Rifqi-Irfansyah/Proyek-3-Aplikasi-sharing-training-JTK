<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Training;
use Illuminate\Http\Request;

class BerandaAdminController extends Controller
{
    public function beranda_admin()
    {
        $trainings = Training::with(['jadwalTrainings', 'user'])->withCount('peserta')->get();
        $now = now()->setTimezone('Asia/Jakarta');

        foreach ($trainings as $training) {
            $meetStart = $training->jadwalTrainings->first()->waktu_mulai;
            $meetEnd = $training->jadwalTrainings->last()->waktu_mulai;
            if ($now >= $meetStart)
                $training->status = 'Berlangsung';
            if ($now >= $meetEnd) 
                $training->status = 'Selesai';

            $training->save();
        }

        $info = Training::with('JadwalTrainings','user')->get();
        return view('admin.BerandaAdmin',compact('info'));
    }

    public function destroy($id)
    {
        // Cari data training berdasarkan id
        $training = Training::find($id);

        // Cek jika data ditemukan, lalu hapus
        if ($training) {
            $training->delete();
            return redirect()->back()->with('success', 'Training successfully deleted.');
        }

        return redirect()->back()->with('error', 'Training not found');
    }

}
