<?php

namespace App\Http\Controllers;

use App\Models\JadwalTraining;
use Illuminate\Http\Request;
use App\Models\TambahanTrainer;

class ApproveTrainerController extends Controller
{
    public function approvetrainer()
    {
        // Mengambil semua data tambahan_trainer beserta user yang terkait
        $trainers = JadwalTraining::with('tambahantrainer')->get();
            
        return view('admin.ApproveTrainer', ['trainers' => $trainers]);
    }
}
