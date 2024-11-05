<?php

namespace App\Http\Controllers;

use App\Models\JadwalTraining;
use Illuminate\Http\Request;
use App\Models\TambahanTrainer;
use App\Models\PengajuanTrainer;
use App\Models\User;


class ApproveTrainerController extends Controller
{
    public function approveTrainer()
    {
        // Ambil data trainer dengan nama training terkait
        $trainers = PengajuanTrainer::with(['user', 'training'])->get(); 
        return view('admin.ApproveTrainer', ['trainers' => $trainers]);
    }

    public function updateStatus_1(Request $request)
    {
        $trainer = PengajuanTrainer::where('email', $request->email)->update(['status_akun' => 'Diterima']);;
    
        if ($trainer) {
            return response()->json(['success' => true]);
        }
    
        return response()->json(['error' => false, 'message' => 'Trainer not found.']);
    }
    

    public function updateStatus_2(Request $request)
    {
        
        $trainer = PengajuanTrainer::where('email', $request->email)->update(['status_akun' => 'Ditolak']);;
    
        if ($trainer) {
            return response()->json(['success' => true]);
        }
    
        
        return response()->json(['error' => true, 'message' => 'Trainer not found.']);
    }
    public function viewTrainerDetail($email)
    {
        $trainer = PengajuanTrainer::where('email_trainer', $email)->with('user')->first();
        
        if (!$trainer) {
            return redirect()->route('approve-trainer')->withErrors('Trainer not found.');
        }

        return view('admin.detailTrainerApprove', ['trainer' => $trainer]);
    }
}
