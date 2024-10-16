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

}
