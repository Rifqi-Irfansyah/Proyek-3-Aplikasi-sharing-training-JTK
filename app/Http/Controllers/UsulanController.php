<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usulan;

class UsulanController extends Controller
{
    public function view_usulan()
    {

        $usulans = Usulan::all();
        return view('admin.usulan', compact('usulans'));

    }

    // public function update(Request $request, $id_usulan)
    // {

    //     $request->validate([
    //         'status' => 'required|in:Dilihat,Belum dilihat',
    //     ]);

    //     $usulan = Usulan::findOrFail($id_usulan);

    //     $usulan->status = $request->status;
    //     $usulan->save();

    //     return redirect()->back()->with('success', 'Status usulan berhasil diubah.');
    // }
}


