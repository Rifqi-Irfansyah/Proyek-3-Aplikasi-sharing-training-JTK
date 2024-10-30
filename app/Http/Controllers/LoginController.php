<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TambahanTrainer;
use Session;

class LoginController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            $role = Auth::user()->role;
            if ($role == 'admin')
                return redirect('BerandaAdmin');

            else if ($role == 'pemateri')
                return redirect('pemateri');

            else if($role == 'peserta')
                return redirect('Beranda');
        }
        else
            return view('auth.login', (['title' => 'Login', 'postLogin' => 'loginaksi', 'signup' => true]));
    }

    public function loginAdmin()
    {
        if (Auth::check()) {
            $role = Auth::user()->role;
            if ($role == 'admin')
                return redirect('BerandaAdmin');

            else if ($role == 'pemateri')
                return redirect('pemateri');

            else if($role == 'peserta')
                return redirect('Beranda');
        }
        else
            return view('auth.login', (['title' => 'Login Admin', 'postLogin' => 'loginaksiAdmin', 'signup' => false]));
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

            if($role == 'peserta'){
                Session::flash('success','Login Success !!');
                return redirect('Beranda');
            }
            else if($role == 'pemateri'){
                $tambahanTrainer = $user->TambahanTrainer;
                if ($tambahanTrainer->status_akun == 'Terkonfirmasi'){
                    if(!$tambahanTrainer->status_login){
                        TambahanTrainer::where('email', $tambahanTrainer->email)->update(['status_login' => true]);
                        Session::flash('info', 'Your Account is Confirmed !!');
                    }
                    return redirect('pemateri');
                }
                else{
                    Session::flash('error', 'Your Account Havent Confirmed');
                    Auth::logout();
                    return redirect()->back();
                }
            }
            else{
                Session::flash('error', 'Username or Password Wrong!!');
                Auth::logout();
                return redirect()->back();
            }
        }
        else{
            Session::flash('error', 'Username or Password Wrong !!');
            return redirect()->back();
        }
    }

    public function loginaksiAdmin(Request $request)
    {
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::Attempt($data)) { 
            $user = Auth::user();
            $role = $user->role;
            if ($role == 'admin'){
                Session::flash('success','Login Success !!');
                return redirect('BerandaAdmin');
            }
            else{
                Session::flash('error', 'Username or Password Wrong!!');
                Auth::logout();
                return redirect()->back();
            }
        }
        else{
            Session::flash('error', 'Username or Password Wrong !!');
            return redirect()->back();
        }
    }

    public function logoutaksi()
    {
        $role = Auth::user()->role;
        Auth::logout();
        if($role == 'admin')
            return redirect('/loginAdmin');
        else
            return redirect('/');
    }

    public function beranda(){
        return view('welcome');
    }
}