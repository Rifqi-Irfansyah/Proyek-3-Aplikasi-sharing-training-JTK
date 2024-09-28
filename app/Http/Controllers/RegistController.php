<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;


class RegistController extends Controller
{
    public function showPesertaForm(Request $request)
    {
        return view('auth.register_peserta'); // Form registrasi peserta
    }

    // public function showTrainerForm()
    //     {
        //         return view('auth.register_trainer'); // Form registrasi trainer
        //     }

        public function registerPeserta(Request $request)
        {
            // Validasi input
            $validatedData = $request->validate([
                'full_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'date_of_birth' => 'required|date',
                'gender' => 'required|string',
                'password' => 'required|string|min:8|confirmed', // Memastikan password dan konfirmasi cocok
            ]);

            // Buat user baru untuk peserta
            $user = User::create([
                'email' => $validatedData['email'],
                'role' => 'peserta', // Role peserta
                'name' => $validatedData['full_name'],
                'gender' => $validatedData['gender'],
                'tanggal_lahir' => $validatedData['date_of_birth'],
                'password' => Hash::make($validatedData['password']),
            ]);

            // Cek apakah user berhasil disimpan
            if ($user) {
                return redirect()->route('login')->with('success', 'Registrasi peserta berhasil!');
            } else {
                return redirect()->back()->with('error', 'Registrasi gagal, silakan coba lagi.');
            }
        }



}
