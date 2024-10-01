<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class Jadwal extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('training')->insert([
            // 'email_trainer' => "pemateri@gmail.com",
            'judul_training' => "Belajar PHP",
            'email_trainer' => "admin@gmail.com",
            'kuota' => 30,
            'deskripsi' => "Belajar PHP dmdmdm amdamda",
            'status' => "Pendaftaran"
        ]);

        DB::table('jadwal_training')->insert([
            'id_training' => 1,
            'tempat_pelaksana' => "R101",
            'status' => "offline",
            'waktu_mulai' => now()->subDays(2),
            'waktu_selesai' => now(),
            'topik_pertemuan' => "lorem 25"
        ]);

        DB::table('jadwal_training')->insert([
            'id_training' => 1,
            'tempat_pelaksana' => "R101",
            'status' => "offline",
            'waktu_mulai' => now(),
            'waktu_selesai' => now(),
            'topik_pertemuan' => "lorem 30"
        ]);

        DB::table('jadwal_training')->insert([
            'id_training' => 1,
            'tempat_pelaksana' => "R101",
            'status' => "offline",
            'waktu_mulai' => now(),
            'waktu_selesai' => now(),
            'topik_pertemuan' => "lorem 10"
        ]);

        DB::table('training')->insert([
            // 'email_trainer' => "pemateri@gmail.com",
            'judul_training' => "Belajar Java",
            'email_trainer' => "admin@gmail.com",
            'kuota' => 30,
            'deskripsi' => "Belajar Java dmdmdm amdamda",
            'status' => "Pendaftaran"
        ]);
    }
}
