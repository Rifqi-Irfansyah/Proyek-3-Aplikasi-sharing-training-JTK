<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Training;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BerandaTrainerController extends Controller
{

    public function CardTrainer()
    {
        $pemateri = Auth::user()->email;
        $trainingDiajarkan = Training::whereHas('user', function ($query) use ($pemateri) {
            $query->where('email_trainer', $pemateri);
        })->get();
        //dd($trainingDiajarkan);
        $trainingTidakaDiajarkan = Training::whereDoesntHave('user', function ($query) use ($pemateri) {
            $query->where('email_trainer', $pemateri);
        })
        ->get();
        $nama = Auth::user()->name;
        return view('trainer.BerandaTrainer', compact('trainingDiajarkan', 'trainingTidakaDiajarkan', 'nama'));
    }


}