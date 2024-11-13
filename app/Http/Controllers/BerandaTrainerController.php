<?php

namespace App\Http\Controllers;

use App\Models\Training;
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

    // public function CardTraining()
    // {
    //     $trainer = Auth::user()->email;
    //     $trainingDiikuti = Training::whereHas('trainer', function ($query) use ($trainer) {
    //         $query->where('email_peserta', $trainer);
    //     })->get();
    //     $trainingBelumDiikuti = Training::whereDoesntHave('trainer', function ($query) use ($trainer) 
    //         $query->where('email_peserta', $trainer);
    //     })->get();
    //     $nama = Auth::user()->name;
    //     return view('peserta.BerandaTrainer', compact('trainingDiikuti','trainingBelumDiikuti','nama')
    // }

    public function detailTraining($id)
    {
        $training = Training::findOrFail($id);
        // Logika untuk menampilkan detail training
        return view('trainer.DetailTraining', compact('training'));
    }

}