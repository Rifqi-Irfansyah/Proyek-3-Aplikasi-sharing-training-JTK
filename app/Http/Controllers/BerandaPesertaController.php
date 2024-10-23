<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Training;
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
        
        return view('peserta.BerandaPeserta', compact('trainingDiikuti','trainingBelumDiikuti'));
    }
}
