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
            'email_trainer' => "pemateri2@gmail.com",
            'kuota' => 30,
            'deskripsi' => "Pelatihan ini dirancang untuk memberikan pemahaman dasar hingga menengah tentang bahasa pemrograman Python. Peserta akan mempelajari berbagai konsep mulai dari sintaks dasar, pengolahan data, hingga pengembangan aplikasi sederhana",
            'status' => "Pendaftaran"
        ]);

        DB::table('jadwal_training')->insert([
            'id_training' => 1,
            'tempat_pelaksana' => "R101",
            'status' => "offline",
            'waktu_mulai' => now()->subDays(2)->setTimezone('Asia/Jakarta'),
            'waktu_selesai' => now()->setTimezone('Asia/Jakarta'),
            'topik_pertemuan' =>
            "Pengenalan Python, sintaks dasar, tipe data, variabel, dan operasi sederhana."
        ]);

        DB::table('jadwal_training')->insert([
            'id_training' => 1,
            'tempat_pelaksana' => "R101",
            'status' => "offline",
            'waktu_mulai' => now()->setTimezone('Asia/Jakarta'),
            'waktu_selesai' => now()->addHours(3)->setTimezone('Asia/Jakarta'),
            'topik_pertemuan' =>
            "Penggunaan if-else, looping (for, while), dan pengenalan fungsi untuk mengorganisir kode."
        ]);

        DB::table('jadwal_training')->insert([
            'id_training' => 1,
            'tempat_pelaksana' => "R101",
            'status' => "offline",
            'waktu_mulai' => now()->addDays(4)->setTimezone('Asia/Jakarta'),
            'waktu_selesai' => now()->addDays(4)->setTimezone('Asia/Jakarta'),
            'topik_pertemuan' =>
            "Pengenalan list, tuple, set, dan dictionary untuk menyimpan dan memanipulasi data."
        ]);

        DB::table('jadwal_training')->insert([
            'id_training' => 1,
            'tempat_pelaksana' => "R101",
            'status' => "offline",
            'waktu_mulai' => now()->addDays(5)->setTimezone('Asia/Jakarta'),
            'waktu_selesai' => now()->addDays(5)->setTimezone('Asia/Jakarta'),
            'topik_pertemuan' =>
            "Pengenalan Projecting, sinkronisasi database dan input hardware"
        ]);

        DB::table('training')->insert([
            'judul_training' => "Belajar CI CD",
            'email_trainer' => "pemateri2@gmail.com",
            'kuota' => 30,
            'deskripsi' => "Pelatihan ini bertujuan untuk memberikan pengenalan mengenai developing program website, dimana sebuah deploy sistem dapat dilakukan secara otomatis dengan konsep CI Cd",
            'status' => "Pendaftaran"
        ]);

        DB::table('jadwal_training')->insert([
            'id_training' => 2,
            'tempat_pelaksana' => "R102",
            'status' => "online",
            'waktu_mulai' => now()->subDays(8)->setTimezone('Asia/Jakarta'),
            'waktu_selesai' => now()->subDays(8)->addHours(2)->setTimezone('Asia/Jakarta'),
            'topik_pertemuan' =>
            "Implementasi pipeline sederhana untuk CI/CD menggunakan GitHub Actions."
        ]);
        
        DB::table('jadwal_training')->insert([
            'id_training' => 2,
            'tempat_pelaksana' => "R103",
            'status' => "offline",
            'waktu_mulai' => now()->subDays(7)->setTimezone('Asia/Jakarta')->addHours(3),
            'waktu_selesai' => now()->subDays(7)->setTimezone('Asia/Jakarta')->addHours(5),
            'topik_pertemuan' =>
            "Konfigurasi CI/CD untuk deployment aplikasi berbasis Laravel."
        ]);
        
        DB::table('jadwal_training')->insert([
            'id_training' => 2,
            'tempat_pelaksana' => "R104",
            'status' => "online",
            'waktu_mulai' => now()->subDays(5)->setTimezone('Asia/Jakarta')->addHours(6),
            'waktu_selesai' => now()->subDays(5)->setTimezone('Asia/Jakarta')->addHours(8),
            'topik_pertemuan' =>
            "Pengenalan tools CI/CD: Jenkins dan GitLab CI/CD."
        ]);
        

        DB::table('jadwal_training')->insert([
            'id_training' => 2,
            'tempat_pelaksana' => "R101",
            'status' => "offline",
            'waktu_mulai' => now()->subDays(4)->setTimezone('Asia/Jakarta'),
            'waktu_selesai' => now()->subDays(4)->setTimezone('Asia/Jakarta'),
            'topik_pertemuan' =>
            "Implementasi CI/CD pada Gitlab menggunakan virtual machine Linux"
        ]);
    }
}
