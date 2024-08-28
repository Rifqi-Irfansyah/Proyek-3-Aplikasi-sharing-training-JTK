<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class LoginController extends Controller
{
    public function login()
    {
        if (Auth::check()) 
        {
            return redirect('home');
        }
        else
        {
            return view('auth.login');
        }
    }

    public function loginaksi(Request $request)
    {
        $data = [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ];

        if (Auth::Attempt($data)) 
        {
            return redirect('home');
        }
        else
        {
            Session::flash('error', 'Username atau Password Salah');
            return redirect()->back();
        }
    }

    public function logoutaksi()
    {
        Auth::logout();
        return redirect('/');
    }
}
