<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training;

class EditTraining extends Controller
{
    
    public function editTraining(Request $request)
{
    // Lihat semua data request
    dd($request->all());

    // Coba temukan data training
    $training = Training::findOrFail($request->id_training);
    dd($training); // Lihat apakah data training ditemukan

    // Jika tidak ada error, lanjutkan dengan update data
    $training->kuota = $request->kuota;
    $training->desc_meet = $request->descMeet;
    $training->save(); 

    // Kirim respons sukses
    return response()->json(['message' => 'Training berhasil diupdate!']);
}

}