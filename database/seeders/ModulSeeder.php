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
            'nama_file' => "Generic Programming.pdf",
            'judul' => "Materi Generic Programming",
        ]);

        DB::table('modul')->insert([
            'nama_file' => "Pertemuan 11 Collection.pdf",
            'judul' => "Materi - Collection"
        ]);

        DB::table('modul')->insert([
            'nama_file' => "2-Java Fundamental.pdf",
            'judul' => "Materi - Fundamental"
        ]);

        DB::table('modul')->insert([
            'nama_file' => "dummy1.pdf",
            'judul' => "Modul Dummy 1"
        ]);

        DB::table('modul')->insert([
            'nama_file' => "dummy2.pdf",
            'judul' => "Modul Dummy 2"
        ]);

        DB::table('modul')->insert([
            'nama_file' => "dummy3.pdf",
            'judul' => "Modul Dummy 3"
        ]);

        DB::table('modul')->insert([
            'nama_file' => "dummy4.pdf",
            'judul' => "Modul Dummy 4"
        ]);

        DB::table('modul')->insert([
            'nama_file' => "dummy5.pdf",
            'judul' => "Modul Dummy 5"
        ]);

        DB::table('modul')->insert([
            'nama_file' => "dummy6.pdf",
            'judul' => "Modul Dummy 6"
        ]);

        DB::table('modul')->insert([
            'nama_file' => "dummy7.pdf",
            'judul' => "Modul Dummy 7"
        ]);

        DB::table('modul')->insert([
            'nama_file' => "dummy8.pdf",
            'judul' => "Modul Dummy 8"
        ]);

        DB::table('modul')->insert([
            'nama_file' => "dummy9.pdf",
            'judul' => "Modul Dummy 9"
        ]);

        DB::table('modul')->insert([
            'nama_file' => "dummy10.pdf",
            'judul' => "Modul Dummy 10"
        ]);

        DB::table('modul_training')->insert([
            'id_training' => 1,
            'nama_file' => "Generic Programming.pdf"
        ]);

        DB::table('modul_training')->insert([
            'id_training' => 1,
            'nama_file' => "Pertemuan 11 Collection.pdf"
        ]);

        DB::table('modul_training')->insert([
            'id_training' => 1,
            'nama_file' => "2-Java Fundamental.pdf"
        ]);

    }
}
