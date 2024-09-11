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
                return redirect('auth.welcome');
            else if($role == 'peserta')
                return redirect();
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
            $role = Auth::user()->role;
            Session::flash('success', 'Login Success !!');
            if ($role == 'admin')
                return redirect('beranda');
            else if ($role == 'pemateri')
                return redirect('welcome');
            else if($role == 'peserta')
                return redirect();
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