<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Modul;

class ModulController extends Controller
{
    public function showModul()
    {
        $modul = Modul::get();
        return view('trainer.modul.listmodul', (['modul' => $modul]));
    }

    public function tambahModul(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:50',
            'file' => 'required|file|mimes:pdf|max:10240'
        ]);

        $file = $request->file('file');
        $namaFile = $file->getClientOriginalName();
        $path = $file->storeAs('uploads', $namaFile, 'public');

        Modul::create([
            'judul' => $request->title,
            'nama_file' => $namaFile,
        ]);

        return response()->json(['success' => 'File upload successfully!'], 200);
    }
}
