<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Training;
use App\Models\PengajuanTrainer;
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


        $trainingPending = PengajuanTrainer::with('training')->whereHas('user', function ($query) use ($pemateri) {
                $query->where('email_trainer', $pemateri)
                ->where('status_pengajuan', 'Dikirim');
            })
            ->get();

        $trainingTidakDiajarkan = Training::whereDoesntHave('pengajuanTrainer', function ($query) use ($pemateri) {
            $query->where('email_trainer', $pemateri)
                    ->whereNotIn('status_pengajuan', ['pending', 'approved', 'rejected']);  // Kondisi status_pengajuan lebih dari satu nilai
        })->whereDoesntHave('user', function ($query) {
            $query->whereNotNull('email');  // Memastikan tidak ada relasi dengan user
        })->get();

        $nama = Auth::user()->name;
        return view('trainer.BerandaTrainer', compact('trainingDiajarkan','trainingPending', 'trainingTidakDiajarkan', 'nama'));
    }


}