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
            'judul_training' => "Belajar Python",
            'email_trainer' => "admin@gmail.com",
            'kuota' => 30,
            'deskripsi' => "Pelatihan ini dirancang untuk memberikan pemahaman dasar hingga menengah tentang bahasa pemrograman Python. Peserta akan mempelajari berbagai konsep mulai dari sintaks dasar, pengolahan data, hingga pengembangan aplikasi sederhana",
            'status' => "Pendaftaran"
        ]);

        DB::table('jadwal_training')->insert([
            'id_training' => 1,
            'tempat_pelaksana' => "R101",
            'status' => "offline",
            'waktu_mulai' => now()->subDays(2),
            'waktu_selesai' => now(),
            'topik_pertemuan' => 
            "Pengenalan Python, sintaks dasar, tipe data, variabel, dan operasi sederhana."
        ]);

        DB::table('jadwal_training')->insert([
            'id_training' => 1,
            'tempat_pelaksana' => "R101",
            'status' => "offline",
            'waktu_mulai' => now(),
            'waktu_selesai' => now()->addHours(3),
            'topik_pertemuan' => 
            "Penggunaan if-else, looping (for, while), dan pengenalan fungsi untuk mengorganisir kode."
        ]);

        DB::table('jadwal_training')->insert([
            'id_training' => 1,
            'tempat_pelaksana' => "R101",
            'status' => "offline",
            'waktu_mulai' => now()->addDays(4),
            'waktu_selesai' => now()->addDays(4),
            'topik_pertemuan' => 
            "Pengenalan list, tuple, set, dan dictionary untuk menyimpan dan memanipulasi data."
        ]);

        DB::table('training')->insert([
            // 'email_trainer' => "pemateri@gmail.com",
            'judul_training' => "Belajar Java",
            'email_trainer' => "admin@gmail.com",
            'kuota' => 30,
            'deskripsi' => "Pelatihan ini bertujuan untuk memberikan pemahaman komprehensif tentang pemrograman Java, dari dasar hingga pengembangan aplikasi sederhana. Peserta akan mempelajari dasar-dasar Java, konsep berorientasi objek, struktur data, dan penerapan praktis dalam pembuatan aplikasi. Setiap sesi mencakup pembelajaran teoritis yang diikuti dengan latihan praktis.",
            'status' => "Pendaftaran"
        ]);
    }
}