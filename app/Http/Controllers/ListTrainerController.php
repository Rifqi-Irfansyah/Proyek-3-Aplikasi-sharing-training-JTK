<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TambahanTrainer;

class ListTrainerController extends Controller
{
    public function index()
    {
        // Mengambil semua data tambahan_trainer beserta user yang terkait
        $trainers = TambahanTrainer::with('user')->get();
            
        return view('admin.ListTrainer', ['trainers' => $trainers]);
    }
}
