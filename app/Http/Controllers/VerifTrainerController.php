<?php

namespace App\Http\Controllers;
use App\Mail\SendEmail; 
use Illuminate\Support\Facades\Mail;
use App\Models\Trainer; 
use Illuminate\Http\Request;
use App\Models\TambahanTrainer;
use Illuminate\Support\Facades\Log;


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
        $trainer = TambahanTrainer::with(['user'])->where('email', $request->email)->first();
        $update = TambahanTrainer::where('email', $request->email)->update(['status_akun' => 'Terkonfirmasi']);;
    
        if ($update) {
            $data = [
                'name' => $trainer['user']->name,
                'body' => '<p>Congratulations your account has been approved</p>
                            <p>Now you can contribute as a trainer!!</p>'
            ];
    
            Mail::to($trainer->email)->send(new SendEmail($data));
            return response()->json(['success' => true]);
        }
    
        return response()->json(['error' => false, 'message' => 'Trainer not found.']);
    }
    

    public function update2Status(Request $request)
    {
        $trainer = TambahanTrainer::with(['user'])->where('email', $request->email)->first();
        $update = TambahanTrainer::where('email', $request->email)->update(['status_akun' => 'Ditolak']);
        
        if ($update) {
            $data = [
                'name' => $trainer['user']->name,
                'body' => '<p>Our team has reviewed your capability and don`t meet our quality and technical standards </p>
                            <p>But, hey! It doesn`t mean you`re bad. You can maximize your potential next time. </p>
                            <p>Have a Nice Day !!</p>'
            ];
    
            Mail::to($trainer->email)->send(new SendEmail($data));
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
