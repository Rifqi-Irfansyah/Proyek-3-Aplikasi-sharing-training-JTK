<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training;
use App\Models\JadwalTraining;
use App\Models\Modul;
use App\Models\ModulTraining;
use App\Models\PesertaTraining;
use App\Models\Absen;

class DetailTraining extends Controller
{
    public function detailTraining($id)
    {
        $training = Training::with(['jadwalTrainings', 'user'],)->find($id);
        $total_peserta = Training::withCount('peserta')->find($id);

        $meetStart = $training->jadwalTrainings->first()->waktu_mulai;
        $meetEnd = $training->jadwalTrainings->last()->waktu_mulai;
        $now = now()->setTimezone('Asia/Jakarta');
        if ($now >= $meetStart){
            $training->status = 'Berlangsung';
            $training->save();
        }
        if ($now >= $meetEnd){
            $training->status = 'Selesai';
            $training->save();
        }

        return view('trainer.detail_training.about', ['training' => $training, 'total_peserta' => $total_peserta]);
    }

    public function detailMeet($id)
    {
        $detailMeet = JadwalTraining::with(['training', 'absen.user'])->find($id);
        $training = Training::with(['jadwalTrainings', 'user'],)->find($detailMeet->id_training);
        $trainerAbsent = Absen::where('id_jadwal', $id)->where('email', $training->email_trainer)->first();
        return view('trainer.detail_training.detailmeet', ['meet' => $detailMeet, 'training' => $training, 'trainerAbsent' => $trainerAbsent]);
    }

    public function modul($id)
    {
        $filenames = ModulTraining::where('id_training', $id)->get();

        $namaFiles = $filenames->pluck('nama_file');
        $modul = Modul::whereIn('nama_file', $namaFiles)->get();
        $training = Training::with(['jadwalTrainings'])->find($id);
        return view('trainer.detail_training.modul', ['modul' => $modul, 'training' => $training]);
    }

    public function tambahMeet(Request $request)
    {
        $total_meet = JadwalTraining::where('id_training', $request->id_training)->count();
        if($total_meet >= 7){
            return response()->json(['error' => 'The Training cannot add meet anymore'], 403);
        }
        $request->validate([
            'startMeet' => 'required|date',
            'endMeet' => 'required|date|after:startMeet',
            'locationMeet' => 'required|string|max:255',
            'status' => 'required|string|max:50',
            'descMeet' => 'required|string|max:500',
        ]);

        $addMeet = JadwalTraining::create([
            'id_training' => $request->id_training,
            'waktu_mulai' => $request->startMeet,
            'waktu_selesai' => $request->endMeet,
            'tempat_pelaksana' => $request->locationMeet,
            'status' => $request->status,
            'topik_pertemuan' => $request->descMeet
        ]);

        $peserta = PesertaTraining::where('id_training', $request->id_training)->get();
        foreach ($peserta as $data) {
            Absen::create([
                'email' => $data->email_peserta,
                'status' => 'Tidak Hadir',
                'id_jadwal' => $addMeet->id_jadwal,
                'updated_at' => NULL
            ]);
        }
        
        return response()->json(['success' => 'Meeting added successfully!'], 200);
    }

    public function tambahModul(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:50',
            'file' => 'required|file|mimes:pdf|max:10240'
        ]);

        $file = $request->file('file');
        $namaFile = $file->getClientOriginalName();
        $path = $file->storeAs('uploads', $namaFile, 'public');

        Modul::create([
            'judul' => $request->title,
            'nama_file' => $namaFile,
        ]);

        ModulTraining::create([
            'id_training' => $request->id_training,
            'nama_file' => $namaFile,
        ]);

        return response()->json(['success' => 'File upload successfully!'], 200);
    }
}