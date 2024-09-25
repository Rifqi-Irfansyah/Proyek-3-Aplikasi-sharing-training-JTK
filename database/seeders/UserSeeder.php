<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ADMIN
        DB::table('users')->insert([
            'email' => "admin@gmail.com",
            'role' => "admin",
            'name' => "Rifqi Irfansyah",
            'password' => Hash::make('123'),
            'tanggal_lahir' => now(),
        ]);

        // TRAINER
        DB::table('users')->insert([
            'email' => "pemateri@gmail.com",
            'role' => "pemateri",
            'name' => "Pemateri 1",
            'password' => Hash::make('123'),
            'tanggal_lahir' => now(),
        ]);

        DB::table('users')->insert([
            'email' => "pemateri2@gmail.com",
            'role' => "pemateri",
            'name' => "Pemateri 1",
            'password' => Hash::make('123'),
            'tanggal_lahir' => now(),
        ]);

        DB::table('tambahan_trainer')->insert([
            'email' => "pemateri@gmail.com",
            'no_wa' => "08965698171",
            'cv' => "dd",
            'status_akun' => "Belum direview",
        ]);

        DB::table('tambahan_trainer')->insert([
            'email' => "pemateri2@gmail.com",
            'no_wa' => "08965698171",
            'cv' => "dd",
            'status_akun' => "Terkonfirmasi",
        ]);

        DB::table('training')->insert([
            // 'email_trainer' => "pemateri@gmail.com",
            'judul_training' => "Belajar PHP",
            'email_trainer' => "admin@gmail.com",
            'kuota' => 30,
            'deskripsi' => "Belajar PHP dmdmdm amdamda",
            'status' => "Pendaftaran"
        ]);
    }
}
