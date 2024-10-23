<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\JadwalTraining;
use Illuminate\Http\Request;
use Session;

class CreateTrainingController extends Controller
{
    // Menampilkan halaman untuk membuat training
    public function create()
    {
        return view('admin.create_training.create_training');
    }

    // Menyimpan data training
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'judul_training' => 'required|string|max:255',
            'jumlah_pertemuan' => 'required|integer|min:1',
            'kuota' => 'required|integer|min:1',
            'deskripsi' => 'required|string',
        ]);

        // Simpan data training
        $training = new Training();
        $training->email_trainer = null; // Set ke null karena trainer belum ada
        $training->judul_training = $request->judul_training;
        $training->kuota = $request->kuota;
        $training->deskripsi = $request->deskripsi;
        $training->status = 'Pendaftaran'; // Status awal
        $training->save();
        return redirect()->route('create.meetings', ['jumlah_pertemuan' => $request->jumlah_pertemuan, 'id_training' => $training->id_training])->with('success', 'Training has been successfully created. Please set the meetings.');
    }

    // Menampilkan halaman untuk mengatur pertemuan
    public function createMeetings($jumlah_pertemuan, $id_training)
    {
        return view('admin.create_training.set_meeting', ['jumlah_pertemuan' => $jumlah_pertemuan, 'id_training' => $id_training]);
    }

    // Menyimpan setiap pertemuan
    public function storeMeetings(Request $request)
    {
        // Validasi input
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

        // Simpan setiap pertemuan
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
        return redirect('BerandaAdmin');
        // return redirect()->route('beranda.admin')->with('success', 'Each training meetings has been successfully created');
    }
}
