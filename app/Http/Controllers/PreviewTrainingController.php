<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PreviewTrainingController extends Controller
{
    public function previewTrainingPeserta()
    {
        return view('peserta.PreviewTrainingPeserta');
    }

    public function previewTrainingTrainer()
    {
        return view('trainer.PreviewTrainingTrainer');
    }
}
