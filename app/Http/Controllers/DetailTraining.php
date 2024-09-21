<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training;

class DetailTraining extends Controller
{
    public function detailTraining($id)
    {
        $training = Training::with('jadwalTrainings')->find($id);

        return view('trainer.detail_training', ['training' => $training]);
    }
}
