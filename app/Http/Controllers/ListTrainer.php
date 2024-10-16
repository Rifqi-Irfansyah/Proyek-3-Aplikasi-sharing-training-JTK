<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TambahanTrainer;

class ListTrainer extends Controller
{
    public function index()
    {
        // Mengambil semua data tambahan_trainer beserta user yang terkait
        $trainers = TambahanTrainer::with('user')->get();

        return view('admin.create_training.ListTrainer', ['trainers' => $trainers]);
    }
}
