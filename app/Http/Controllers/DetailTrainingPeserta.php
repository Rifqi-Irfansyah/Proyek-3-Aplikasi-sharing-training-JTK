<?php

namespace App\Http\Controllers;


use App\Models\JadwalTraining;
use Illuminate\Http\Request;
use App\Models\Training;
use App\Models\Absen;
use App\Models\ModulTraining;
use App\Models\Modul;

class DetailTrainingPeserta extends Controller
{
    public function detailTrainingPeserta($id)
    {
        $now = now()->setTimezone('Asia/Jakarta');
        $training = Training::with(['jadwalTrainings', 'user'],)->find($id);
        $total_peserta = Training::withCount('peserta')->find($id);
        $meetStart = $training->jadwalTrainings->first()->waktu_mulai;
        $meetEnd = $training->jadwalTrainings->last()->waktu_mulai;
        if ($now >= $meetStart){
            $training->status = 'Berlangsung';
            $training->save();
        }
        if ($now >= $meetEnd){
            $training->status = 'Selesai';
            $training->save();
        }
        return view('peserta.detail_training.about', ['training' => $training, 'total_peserta' => $total_peserta]);
    }

    public function detailMeetPeserta($id)
    {
        $detailMeet = JadwalTraining::with(['training', 'absen.user'])->find($id);
        $training = Training::with(['jadwalTrainings', 'user'],)->find($detailMeet->id_training);
        $trainerAbsent = Absen::where('id_jadwal', $id)->where('email', $training->email_trainer)->first();
        return view('peserta.detail_training.detailmeet', ['meet' => $detailMeet, 'training' => $training, 'trainerAbsent' => $trainerAbsent]);
    }

    public function modulPeserta($id)
    {
        $filenames = ModulTraining::where('id_training', $id)->get();

        $namaFiles = $filenames->pluck('nama_file');
        $modul = Modul::whereIn('nama_file', $namaFiles)->get();
        $training = Training::with(['jadwalTrainings'])->find($id);
        return view('peserta.detail_training.modul', ['modul' => $modul, 'training' => $training]);
    }
}
