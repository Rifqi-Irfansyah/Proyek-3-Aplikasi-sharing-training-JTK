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
            $request->validate([
                'full_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'date_of_birth' => 'required|date',
                'gender' => 'required|string',
                'password' => 'required|string|min:8|confirmed',
            ]);

            // Buat user baru untuk peserta
            $user = User::create([
                'email' => $request->email,
                'role' => 'peserta', // Role peserta
                'name' => $request->full_name,
                'gender' => $request->gender,
                'tanggal_lahir' => $request->date_of_birth,
                'password' => Hash::make($request->password),
            ]);

            if($user){
                return view('auth.login')->with('success', 'Registrasi peserta berhasil!');
            }
            else{

            }

        }


}
