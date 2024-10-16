<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class LoginController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            $role = Auth::user()->role;
            if ($role == 'admin')
                return redirect('beranda');

            else if ($role == 'pemateri')
                return redirect('pemateri');

            else if($role == 'peserta')
                return redirect('peserta');
        }
        else
            return view('auth.login');
    }

    public function loginaksi(Request $request)
    {
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::Attempt($data)) { 
            $user = Auth::user();
            $role = $user->role;

            if ($role == 'admin')
                return redirect('beranda');

            else if($role == 'peserta')
                return redirect();

            else if($role == 'pemateri'){
                $tambahanTrainer = $user->TambahanTrainer;
                if ($tambahanTrainer->status_akun == 'Terkonfirmasi')
                    return redirect('pemateri');
                else{
                    Session::flash('error', 'Your Account Havent Confirmed');
                    Auth::logout();
                    return redirect()->back();
                }
            }
            Session::flash('success', 'Login Success !!');
        }
        else{
            Session::flash('error', 'Username or Password Wrong !!');
            return redirect()->back();
        }
    }

    public function logoutaksi()
    {
        Auth::logout();
        return redirect('/');
    }

    public function beranda(){
        return view('welcome');
    }
}