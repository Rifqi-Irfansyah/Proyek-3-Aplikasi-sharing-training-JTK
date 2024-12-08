<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Training;
use App\Models\Usulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
USE illuminate\Support\Collection;

class BerandaPesertaController extends Controller
{
    public function CardTraining()
    {
        $peserta = Auth::user()->email;
        $trainingDiikuti = Training::whereHas('peserta', function ($query) use ($peserta) {
            $query->where('email_peserta', $peserta)
            ->whereIn('status',['Pendaftaran','Berlangsung']);
        })->get();

        $trainingSelesai = Training::whereHas('peserta', function ($query) use ($peserta) {
            $query->where('email_peserta', $peserta)
            ->where('status','Selesai');
        })->get();

        $trainingTidakDiikuti = Training::whereDoesntHave('peserta', function ($query) use ($peserta) {
            $query->where('email_peserta', $peserta);
        })
        ->get();

        $trainingBelumDiikuti = collect();


        foreach ($trainingTidakDiikuti as $tr) {
            $total_kuota= Training::withCount('peserta')->find($tr->id_training);
            if($tr->kuota > $total_kuota->peserta_count && $tr->status === 'Pendaftaran')
                $trainingBelumDiikuti->push($tr);
        }

        $nama = Auth::user()->name;
        return view('peserta.BerandaPeserta', compact('trainingDiikuti', 'trainingSelesai', 'trainingBelumDiikuti', 'nama'));
    }

    // public function kuotaTraining($id)
    // {
        //     $kuota_training = Training::withCount('peserta')->find($id);
        //     return view('peserta.BerandaPeserta',compact('kuota_training'));

    // }

    public function store(Request $request)
    {
        $request->validate([
            'judul_materi' => 'required|string|max:50',
            'bahasan' => 'required|string|max:255',
            'email_pengusul' => 'required|email|exists:users,email', // Validasi email
        ]);

        Usulan::create([
            'judul_materi' => $request->judul_materi,
            'bahasan' => $request->bahasan,
            'email_pengusul' => $request->email_pengusul,
        ]);

        return redirect()->back()->with('success', 'Usulan berhasil dikirim!');
    }
}
