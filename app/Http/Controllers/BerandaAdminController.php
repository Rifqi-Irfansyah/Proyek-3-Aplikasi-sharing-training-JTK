<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Training;
use App\Models\JadwalTraining;
use App\Models\Absen;
use App\Models\Modul;
use Illuminate\Http\Request;

class BerandaAdminController extends Controller
{
    public function beranda_admin()
    {
        $info = Training::with('JadwalTrainings','user')->get();
        return view('admin.BerandaAdmin',compact('info'));
    }

    public function delete($id)
    {
        $training = Training::with(['Modul', 'JadwalTrainings'])->find($id);
    

        if (!$training) {
            return redirect()->back()->with('error', 'Training not found');
        }

        if($training->status === 'Pendaftaran')
        {
            $training->Modul()->delete();
        
            foreach ($training->jadwalTrainings as $jadwal) {
                $jadwal->absen()->delete();
            }
            $training->jadwalTrainings()->delete();
            $training->delete();
            return redirect()->route('beranda.admin')->with('success', 'Training successfully deleted.');
        }
        else {
            return redirect()->back()->with('error', 'Data tidak dapat dihapus karena status training bukan pendaftaran.');
        }
    }

        
    
}
