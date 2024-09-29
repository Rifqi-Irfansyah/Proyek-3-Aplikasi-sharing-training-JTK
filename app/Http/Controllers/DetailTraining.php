<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training;
use App\Models\JadwalTraining;

class DetailTraining extends Controller
{
    public function detailTraining($id)
    {
        $training = Training::with(['jadwalTrainings', 'user'],)->find($id);
        return view('trainer.detail_training.about', ['training' => $training]);
    }

    public function detailMeet($id)
    {
        $detailMeet = JadwalTraining::find($id);
        $training = Training::with(['jadwalTrainings', 'user'],)->find($detailMeet->id_training);
        return view('trainer.detail_training.detailmeet', ['meet' => $detailMeet, 'training' => $training]);
    }

    public function modul($id)
    {
        $training = Training::with(['jadwalTrainings', 'user'],)->find($id);
        return view('trainer.detail_training.modul', ['training' => $training]);
    }

    public function tambahMeet(Request $request)
    {
            // Validate the incoming request data
        $request->validate([
            'startMeet' => 'required|date',
            'endMeet' => 'required|date|after:startMeet',
            'locationMeet' => 'required|string|max:255',
            'status' => 'required|string|max:50',
        ]);

        JadwalTraining::create([
            'waktu_mulai' => $request->startMeet,
            'waktu_selesai' => $request->endMeet,
            'tempat_pelaksana' => $request->locationMeet,
            'status' => $request->status,
        ]);

        return response()->json(['success' => 'Meeting added successfully!'], 200);
    }
}