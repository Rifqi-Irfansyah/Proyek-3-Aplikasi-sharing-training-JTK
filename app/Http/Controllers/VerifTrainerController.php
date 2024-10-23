<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TambahanTrainer;

class VerifTrainerController extends Controller
{
    public function verifadmin()
    {
        // Mengambil emua data tambahan_trainer beserta user yang terkait
        $trainers = TambahanTrainer::with('user')->get();

            
        return view('admin.VerifTrainer', ['trainers' => $trainers]);
    }
}
