<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PreviewTrainingController extends Controller
{
    public function previewTraining()
    {
        return view('peserta.PreviewTraining');
    }
}
