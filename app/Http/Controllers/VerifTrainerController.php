<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TambahanTrainer;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
class VerifTrainerController extends Controller
{
    public function verifTrainer()
    {
        // Mengambil semua data tambahan_trainer beserta user yang terkait
        $trainers = TambahanTrainer::with('user')->get();
        
        return view('admin.VerifTrainer', ['trainers' => $trainers]);
    } 

    public function updateStatus(Request $request)
    {
        $trainer = TambahanTrainer::where('email', $request->email)->update(['status_akun' => 'Terkonfirmasi']);;
    
        if ($trainer) {
            return response()->json(['success' => true]);
        }
    
        return response()->json(['error' => false, 'message' => 'Trainer not found.']);
    }
    

    public function update2Status(Request $request)
    {
        
        $trainer = TambahanTrainer::where('email', $request->email)->update(['status_akun' => 'Ditolak']);;
    
        if ($trainer) {
            return response()->json(['success' => true]);
        }
    
        
        return response()->json(['error' => true, 'message' => 'Trainer not found.']);
    }

    



}
