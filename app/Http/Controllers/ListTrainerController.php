<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TambahanTrainer;

class ListTrainerController extends Controller
{
    public function index(Request $request)
    {
        // Ambil parameter sort dari query string
        $sortBy = $request->input('sort', 'name'); // Default sort by 'name'

        // Mapping untuk kolom yang akan digunakan dalam sort
        $sortableColumns = [
            'name' => 'users.name', // Nama dari relasi user
            'status_akun' => 'tambahan_trainer.status_akun',
            'email' => 'tambahan_trainer.email',
        ];

        // Cek jika kolom sorting valid
        $sortColumn = $sortableColumns[$sortBy] ?? 'users.name';

        // Mengambil semua data tambahan_trainer beserta user yang terkait, lalu sorting berdasarkan kolom yang dipilih
        $trainers = TambahanTrainer::with('user')
            ->join('users', 'tambahan_trainer.email', '=', 'users.email')
            ->orderBy($sortColumn, 'asc') // Urutan bisa diubah ke desc jika dibutuhkan
            ->get(['tambahan_trainer.*', 'users.name', 'users.gender', 'users.tanggal_lahir']);

        return view('admin.ListTrainer', ['trainers' => $trainers, 'sortBy' => $sortBy]);
    }
}
