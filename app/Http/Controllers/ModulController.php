<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use App\Models\Modul;
use PDOException;


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

    public function editModul(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:50',
        ]);

        $modul = Modul::find($request->name_file);
        $modul->judul = $request->title;
        if($request->file != "undefined"){
            $request->validate([
                'file' => 'nullable|required|file|mimes:pdf|max:10240'
            ]);
            $file = $request->file('file');
            $namaFile = $file->getClientOriginalName();
            $path = $file->storeAs('uploads', $namaFile, 'public');

            $modul->nama_file = $namaFile;

        }
        $modul->save();

        return response()->json(['success' => 'File upload successfully!'], 200);
    }

    public function deleteModul(Request $request)
    {
        try {
            $modul = Modul::find($request->nameFile);
            if (!$modul)
                return response()->json(['error' => 'Modul not found'], 404);
            
            $filePath = 'public/uploads/'.$modul->nama_file;
            if (Storage::exists($filePath))
                Storage::delete($filePath);
            
            $modul->delete();
            return response()->json(['success' => 'Modul deleted successfully'], 200);
            
        } catch (QueryException $e) {
            if ($e->getCode() == '23000' && strpos($e->getMessage(), '1451') !== false) {
                return response()->json([
                    'error' => 'This file is used in training'
                ], 400);
            }
            return response()->json(['error' => 'Terjadi kesalahan saat menghapus file'], 500);
        }
    }

}