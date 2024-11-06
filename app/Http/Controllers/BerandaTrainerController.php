<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\Usulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BerandaTrainerController extends Controller
{
    public function index()
    {
        $trainer = Auth::user();
        $nama_trainer = $trainer->name;
        $listTrainingDiajarkan = Training::where('email_trainer', $trainer->email)->get();
        $listTrainingBelumDiajarkan = Training::where('email_trainer', $trainer->email)->get();

        return view('trainer.BerandaTrainer', compact('nama_trainer', 'listTrainingDiajarkan', 'listTrainingBelumDiajarkan'));
    }

    public function detailTraining($id)
    {
        $training = Training::findOrFail($id);
        // Logika untuk menampilkan detail training
        return view('trainer.DetailTraining', compact('training'));
    }

    public function tambahTraining($id)
    {
        $training = Training::findOrFail($id);
        // Logika untuk menambahkan training baru ke daftar training yang diajarkan
        $training->trainers()->attach(Auth::user()->id);
        return redirect()->route('welcome')->with('success', 'Training berhasil ditambahkan.');
    }

    public function storeUsulan(Request $request)
    {
        $request->validate([
            'judul_materi' => 'required|string|max:50',
            'bahasan' => 'required|string|max:255',
            'usulan' => 'required|string|max:255',
            'email_pengusul' => 'required|email|exists:users,email', // Validasi email
        ]);

        Usulan::create([
            'judul_materi' => $request->judul_materi,
            'bahasan' => $request->bahasan,
            'email_pengusul' => $request->email_pengusul, // Ambil dari input email
            'usulan' => $request->usulan,
        ]);

        return redirect()->back()->with('success', 'Usulan berhasil dikirim!');
    }
}