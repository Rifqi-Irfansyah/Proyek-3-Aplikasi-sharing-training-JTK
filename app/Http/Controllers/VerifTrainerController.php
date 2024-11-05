<?php

namespace App\Http\Controllers;
use App\Mail\SendEmail; // Import class email
use Illuminate\Support\Facades\Mail;
use App\Models\Trainer; // Pastikan model Trainer sudah diimport
use Illuminate\Http\Request;
use App\Models\TambahanTrainer;

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
    public function viewTrainerDetail($email)
    {
        $trainer = TambahanTrainer::where('email', $email)->with('user')->first();
        
        if (!$trainer) {
            return redirect()->route('verifTrainer')->withErrors('Trainer not found.');
        }

        return view('admin.trainerDetail', ['trainer' => $trainer]);
    }

    protected function verifyTrainer($trainer)
    {
        $data = [
            'name' => $trainer->user->name,
            'status_akun' => $trainer->status,
        ];

        Mail::to($trainer->email)->send(new SendEmail($data));
    }

}
