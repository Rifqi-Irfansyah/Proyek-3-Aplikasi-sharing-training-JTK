<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\JadwalTraining;
use Illuminate\Http\Request;
use Session;

class CreateTrainingController extends Controller
{
    public function create()
    {
        return view('admin.create_training.create_training');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_training' => 'required|string|max:255',
            'jumlah_pertemuan' => 'required|integer|min:1',
            'kuota' => 'required|integer|min:1',
            'deskripsi' => 'required|string',
        ]);

        $training = new Training();
        $training->email_trainer = null; // Set ke null karena trainer belum ada
        $training->judul_training = $request->judul_training;
        $training->kuota = $request->kuota;
        $training->deskripsi = $request->deskripsi;
        $training->status = 'Pendaftaran'; // Status awal
        $training->save();
        Session::flash('success', 'Training is successfully created, please set each meeting');
        Session::flash('createTraining');
        return redirect()->route('create.meetings', ['jumlah_pertemuan' => $request->jumlah_pertemuan, 'id_training' => $training->id_training])->with('success', 'Training has been successfully created. Please set the meetings.');
    }

    public function createMeetings($jumlah_pertemuan, $id_training)
    {
        if (session('createTraining')){
            return view('admin.create_training.set_meeting', ['jumlah_pertemuan' => $jumlah_pertemuan, 'id_training' => $id_training]);
        }
        return abort(403);
    }

    public function storeMeetings(Request $request)
    {
        $request->validate([
            'topik_pertemuan' => 'required|array',
            'topik_pertemuan.*' => 'required|string',
            'waktu_mulai' => 'required|array',
            'waktu_mulai.*' => 'required|date',
            'waktu_selesai' => 'required|array',
            'waktu_selesai.*' => 'required|date',
            'status' => 'required|array',
            'status.*' => 'required|string',
            'tempat_pelaksana' => 'required|array',
            'tempat_pelaksana.*' => 'required|string',
        ]);

        foreach ($request->topik_pertemuan as $key => $topik) {
            $jadwal = new JadwalTraining();
            $jadwal->id_training = $request->id_training;
            $jadwal->topik_pertemuan = $topik;
            $jadwal->waktu_mulai = $request->waktu_mulai[$key];
            $jadwal->waktu_selesai = $request->waktu_selesai[$key];
            $jadwal->status = $request->status[$key];
            $jadwal->tempat_pelaksana = $request->tempat_pelaksana[$key];
            $jadwal->save();
        }
        Session::flash('success', 'Each training meetings has been successfully created');
        return redirect()->route('beranda.admin');
        // return redirect()->route('beranda.admin')->with('success', 'Each training meetings has been successfully created');
    }
}
