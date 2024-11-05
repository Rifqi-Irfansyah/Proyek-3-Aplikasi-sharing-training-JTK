<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Training;
use App\Models\Usulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BerandaPesertaController extends Controller
{
    public function CardTraining()
    {
        $peserta = Auth::user()->email;
        $trainingDiikuti = Training::whereHas('peserta', function ($query) use ($peserta) {
            $query->where('email_peserta', $peserta);
        })->get();

        $trainingBelumDiikuti = Training::whereDoesntHave('peserta', function ($query) use ($peserta) {
            $query->where('email_peserta', $peserta);
        })->get();
        $nama = Auth::user()->name;
        return view('peserta.BerandaPeserta', compact('trainingDiikuti','trainingBelumDiikuti','nama'));
    }

    public function store(Request $request)
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
