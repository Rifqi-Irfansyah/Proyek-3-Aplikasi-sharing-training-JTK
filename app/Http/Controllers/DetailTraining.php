<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training;
use App\Models\JadwalTraining;

class DetailTraining extends Controller
{
    public function detailTraining($id)
    {
        $training = Training::with(['jadwalTrainings', 'user'],)->find($id);
        return view('trainer.detail_training.about', ['training' => $training]);
    }

    public function detailMeet($id)
    {
        $detailMeet = JadwalTraining::find($id);
        $training = Training::with(['jadwalTrainings', 'user'],)->find($detailMeet->id_training);
        return view('trainer.detail_training.detailmeet', ['meet' => $detailMeet, 'training' => $training]);
    }
}
