<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Training;
use Illuminate\Http\Request;

class BerandaAdminController extends Controller
{
    public function beranda_admin()
    {
        $info = Training::with('JadwalTrainings','user')->get();
        return view('admin.BerandaAdmin',compact('info'));
    }

    public function destroy($id)
    {
        // Cari data training berdasarkan id
        $training = Training::find($id);

        // Cek jika data ditemukan, lalu hapus
        if ($training) {
            $training->delete();
            return redirect()->back()->with('success', 'Training successfully deleted.');
        }

        return redirect()->back()->with('error', 'Training not found');
    }

}
