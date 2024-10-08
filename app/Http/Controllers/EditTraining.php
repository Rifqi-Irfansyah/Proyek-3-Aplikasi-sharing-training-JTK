<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training;
use App\Models\PesertaTraining;

class EditTraining extends Controller
{
    
    public function editTraining(Request $request)
    {
        $total_peserta = PesertaTraining::where('id_training', $request->id)->count();
        $minKuota = max($total_peserta, 10);
        $request->validate([
            'kuota' => "required|numeric|min:{$minKuota}|max:30",
            'descMeet' => 'required|string|max:500'
        ]);

        $training = Training::find($request->id);
        $training->kuota = $request->kuota;
        $training->deskripsi = $request->descMeet;
        $training->save();

        return response()->json(['success' => 'Meeting added successfully!'], 200);
    }

}