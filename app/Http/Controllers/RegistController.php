<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TambahanTrainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;


class RegistController extends Controller
{
    public function showPesertaForm(Request $request)
    {
        return view('auth.register_peserta');
    }

    public function showTrainerForm()
    {
        return view('auth.register_trainer');
    }

        public function registerPeserta(Request $request)
        {
            $validatedData = $request->validate([
                'full_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'date_of_birth' => 'required|date',
                'gender' => 'required|string',
                'password' => 'required|string|min:8|confirmed',
            ]);

            $user = User::create([
                'email' => $validatedData['email'],
                'role' => 'peserta', // Role peserta
                'name' => $validatedData['full_name'],
                'gender' => $validatedData['gender'],
                'tanggal_lahir' => $validatedData['date_of_birth'],
                'password' => Hash::make($validatedData['password']),
            ]);

            if ($user) {
                // Session::flash('success', 'Your Account Success Registered');
                // return view('auth.login', (['title' => 'Login', 'postLogin' => 'loginaksi', 'signup' => true]));
                return redirect()->route('login')->with('success', 'Your Account Success Registered');
            } else {
                // Session::flash('error', 'Register failed. Please Try again.');
                // return redirect()->back();
                return redirect()->back()->with('error', 'Register failed. Please Try again.');
            }
        }

        public function registerTrainer(Request $request)
        {
            $validatedData = $request->validate([
                'full_name' => 'required|string|max:50',
                'email' => 'required|string|email|max:50|unique:users,email',
                'gender' => 'required|in:laki-laki,perempuan',
                'date_of_birth' => 'required|date',
                'password' => 'required|string|min:8|confirmed',
                'no_wa' => 'required|string|max:20',
                'kemampuan' => 'required|string|max:255',
                'pengalaman' => 'required|in:belum ada,<1 tahun,1-3 tahun,3 tahun +',
            ]);

    $user = User::create([
        'email' => $validatedData['email'],
        'role' => 'pemateri',
        'name' => $validatedData['full_name'],
        'gender' => $validatedData['gender'],
        'tanggal_lahir' => $validatedData['date_of_birth'],
        'password' => Hash::make($validatedData['password']),
    ]);

    if ($user) {
        $trainer = TambahanTrainer::create([
            'email' => $user->email,
            'no_wa' => $validatedData['no_wa'],
            'kemampuan' => $validatedData['kemampuan'],
            'pengalaman' => $validatedData['pengalaman'],
            'status_akun' => 'Belum direview',

        ]);

        // Session::flash('success', 'Your Account Success Registered');
        // return view('auth.login', (['title' => 'Login', 'postLogin' => 'loginaksi', 'signup' => true]));
        return redirect()->route('login')->with('success', 'Your Account Success Registered');
    } else {
        // Session::flash('error', 'Register failed. Please Try again.');
        // return redirect()->back();
        return redirect()->back()->with('error', 'Register failed. Please Try again.');
    }
        }


}
