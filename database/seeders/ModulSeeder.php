<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modul')->insert([
            'nama_file' => "Pertemuan09 BMC.pdf",
            'judul' => "Materi BMC",
        ]);

        DB::table('modul')->insert([
            'nama_file' => "kardinalitas.pdf",
            'judul' => "Materi Kardinalitas"
        ]);

        DB::table('modul')->insert([
            'nama_file' => "document.pdf",
            'judul' => "Materi PBO"
        ]);

        DB::table('modul')->insert([
            'nama_file' => "employee.pdf",
            'judul' => "Bahan Ajar PBO"
        ]);

        DB::table('modul')->insert([
            'nama_file' => "kardinalitas2.pdf",
            'judul' => "Materi Pertemuan 2 Python"
        ]);

        DB::table('modul_training')->insert([
            'id_training' => 1,
            'nama_file' => "Pertemuan09 BMC.pdf"
        ]);

        DB::table('modul_training')->insert([
            'id_training' => 1,
            'nama_file' => "employee.pdf"
        ]);

        DB::table('modul_training')->insert([
            'id_training' => 1,
            'nama_file' => "document.pdf"
        ]);

    }
}
