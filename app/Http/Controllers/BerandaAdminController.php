<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Training;
use Illuminate\Support\Carbon;
use App\Models\JadwalTraining;
use App\Models\Absen;
use App\Models\Modul;
use Illuminate\Http\Request;

class BerandaAdminController extends Controller
{
    public function beranda_admin()
    {
        $trainings = Training::with(['jadwalTrainings', 'user'])->withCount('peserta')->get();
        $now = now()->setTimezone('Asia/Jakarta');

        foreach ($trainings as $training) {
            $meetStart = $training->jadwalTrainings->first()->waktu_mulai;
            $meetEnd = $training->jadwalTrainings->last()->waktu_mulai;
            $total_peserta = Training::withCount('peserta')->find($training->id_training);

            if ($meetStart) {
                $timeMinusOneDay = Carbon::parse($meetStart)->subDay();

                if ($training->email_trainer === NULL && $now >= $timeMinusOneDay) {
                    $deletedTrainingsNoTrainer[] = $training->judul_training;
                    foreach ($training->jadwalTrainings as $jadwal) {
                        $jadwal->absen()->delete();
                    }
                    $training->jadwalTrainings()->delete();
                    $training->Modul()->delete();
                    $training->delete();
                    continue;
                }

                if ($total_peserta->peserta_count <= 10 && $now >= $timeMinusOneDay) {
                    $deletedTrainingsLowParticipants[] = $training->judul_training;
                    foreach ($training->jadwalTrainings as $jadwal) {
                        $jadwal->absen()->delete();
                    }
                    $training->jadwalTrainings()->delete();
                    $training->Modul()->delete();
                    $training->delete();
                    continue;
                }
            }

            if ($now >= $meetStart)
                $training->status = 'Berlangsung';
            if ($now >= $meetEnd)
                $training->status = 'Selesai';

            $training->save();
        }

        if (!empty($deletedTrainingsNoTrainer)) {
            $message = 'The trainings below were deleted because they did not have trainers: ' . implode(', ', $deletedTrainingsNoTrainer);
            session()->flash('warning', $message);
        }

        if (!empty($deletedTrainingsLowParticipants)) {
            $message = 'The trainings below were deleted because they had less than 10 participants: ' . implode(', ', $deletedTrainingsLowParticipants);
            session()->flash('warning', $message);
        }

        $info = Training::with('JadwalTrainings','user')->get();
        return view('admin.BerandaAdmin',compact('info'));
    }

    public function delete($id)
    {
        $training = Training::with(['Modul', 'JadwalTrainings'])->find($id);


        if (!$training) {
            return redirect()->back()->with('error', 'Training not found');
        }

        if($training->status === 'Berlangsung')
        {
            return redirect()->back()->with('error', 'Training  is currently running and cannot be deleted.');

        }
        if($training->status === 'Selesai')
        {
            return redirect()->back()->with('error', 'Training is done and cannot be deleted.');
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

    }



}
