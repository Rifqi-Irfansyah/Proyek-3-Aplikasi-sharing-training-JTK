<?php

namespace App\Http\Controllers;

use App\Models\PengajuanTrainer;
use App\Models\Training;
use App\Models\PesertaTraining;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class PreviewTrainingController extends Controller
{
    public function previewTrainingPeserta($id)
    {
        $training = Training::with(['jadwalTrainings', 'user'],)->find($id);
        $total_pertemuan = Training::withCount('jadwalTrainings')->find($id);

        return view('peserta.PreviewTrainingPeserta', ['training' => $training, 'total_pertemuan' => $total_pertemuan]);
    }

    public function joinTrainingPeserta($id)
    {
        $emailPeserta = Auth::user()->email;

        // Cek apakah peserta sudah terdaftar di training ini
        $isAlreadyJoined = PesertaTraining::where('id_training', $id)
            ->where('email_peserta', $emailPeserta)
            ->exists();

        if (!$isAlreadyJoined) {
            PesertaTraining::create([
                'id_training' => $id,
                'email_peserta' => $emailPeserta,
            ]);
            // Session::flash('success', 'You have successfully joined the training!');
            // return redirect()->route('beranda.admin');
            return redirect()->route('detailTrainingPeserta', ['id' => $id])->with('success', 'You have successfully joined the training!');
        }

        // Session::flash('error', 'You are already registered for this training.');
        return redirect()->back()->with('error', 'You are already registered for this training.');
    }


    public function previewTrainingTrainer($id)
    {
        $training = Training::with(['jadwalTrainings', 'user'],)->find($id);
        $total_pertemuan = Training::withCount('jadwalTrainings')->find($id);

        return view('trainer.PreviewTrainingTrainer', ['training' => $training, 'total_pertemuan' => $total_pertemuan]);
    }

    public function joinTrainingTrainer($id)
    {
        $emailTrainer = Auth::user()->email;

        // Cek apakah peserta sudah terdaftar di training ini
        $isAlreadyJoined = PengajuanTrainer::where('id_training', $id)
            ->where('email_trainer', $emailTrainer)
            ->exists();

        if (!$isAlreadyJoined) {
            PengajuanTrainer::create([
                'id_training' => $id,
                'email_trainer' => $emailTrainer,
                'status_pengajuan' => 'Dikirim',
            ]);
            // Session::flash('success', 'You have successfully joined the training!');
            // return redirect()->route('beranda.admin');PengajuanTrainer redirect()->route('detailTrainingPeserta', ['id' => $id])->with('success', 'You have successfully joined the training!');
            return redirect()->route('detailTraining', ['id' => $id])->with('success', 'You have successfully joined the training!');
        }

        // Session::flash('error', 'You are already registered for this training.');
        return redirect()->back()->with('error', 'You are already registered for this training.');
    }
}
