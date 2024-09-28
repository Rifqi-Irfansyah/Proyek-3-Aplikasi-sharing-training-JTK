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
        // ADMIN
        DB::table('jadwal_training')->insert([
            'id_training' => 1,
            'tempat_pelaksana' => "R101",
            'status' => "offline",
            'waktu_mulai' => now()->subDays(2),
            'waktu_selesai' => now()
        ]);

        DB::table('jadwal_training')->insert([
            'id_training' => 1,
            'tempat_pelaksana' => "R101",
            'status' => "offline",
            'waktu_mulai' => now(),
            'waktu_selesai' => now()
        ]);

        DB::table('jadwal_training')->insert([
            'id_training' => 1,
            'tempat_pelaksana' => "R101",
            'status' => "offline",
            'waktu_mulai' => now(),
            'waktu_selesai' => now()
        ]);
    }
}
