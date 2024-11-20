<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\TambahanTrainer;
use App\Models\PengajuanTrainer;
use App\Models\Training;
use App\Models\User;
use Illuminate\Support\Facades\Log;


class ApproveTrainerController extends Controller
{
    public function approveTrainer()
    {
        $trainers = PengajuanTrainer::with(['user', 'training'])->whereNot('status_pengajuan', 'Diterima')->get();
        return view('admin.ApproveTrainer', ['trainers' => $trainers]);
    }

    public function updateStatus_1(Request $request)
    {
        PengajuanTrainer::where('email_trainer', $request->email)
            ->where('id_training', $request->id_training)
            ->update(['status_pengajuan' => 'Diterima']);

        PengajuanTrainer::where('id_training', $request->id_training)
            ->where('email_trainer', '!=', $request->email)
                ->update(['status_pengajuan' => "Ditolak"]);

        Training::where('id_training', $request->id_training)
            ->update(['email_trainer' => $request->email] );

        return response()->json(['success' => true]);
    }


    public function updateStatus_2(Request $request)
    {

        PengajuanTrainer::where('email_trainer', $request->email)
            ->where('id_training', $request->id_training)
            ->update(['status_pengajuan' => 'Ditolak']);

        return response()->json(['success' => true]);

    }

    public function viewTrainerDetail($email, $id_training)
    {
        $trainer = PengajuanTrainer::where('email_trainer', $email)->where('id_training', $id_training)->with(['user', 'training'])->first();

        if (!$trainer) {
            return redirect()->route('approve-trainer')->withErrors('Trainer not found.');
        }

        $tambahanTrainer = TambahanTrainer::where('email', $email)->first();

        return view('admin.detailTrainerApprove', ['trainer' => $trainer,'tambahanTrainer' => $tambahanTrainer]);
    }

}
