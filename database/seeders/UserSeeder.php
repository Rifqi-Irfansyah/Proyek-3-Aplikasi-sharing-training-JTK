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

        // PESERTA
        DB::table('users')->insert([
            'email' => "user@gmail.com",
            'role' => "peserta",
            'name' => "Rifqi Irfansyah",
            'password' => Hash::make('123'),
            'tanggal_lahir' => now(),
        ]);

        DB::table('users')->insert([
            'email' => "user1@gmail.com",
            'role' => "peserta",
            'name' => "Peserta 1",
            'password' => Hash::make('123'),
            'tanggal_lahir' => now(),
        ]);

        DB::table('users')->insert([
            'email' => "user2@gmail.com",
            'role' => "peserta",
            'name' => "Peserta 2",
            'password' => Hash::make('123'),
            'tanggal_lahir' => now(),
        ]);
        
        DB::table('users')->insert([
            'email' => "user3@gmail.com",
            'role' => "peserta",
            'name' => "Peserta 3",
            'password' => Hash::make('123'),
            'tanggal_lahir' => now(),
        ]);
        
        DB::table('users')->insert([
            'email' => "user4@gmail.com",
            'role' => "peserta",
            'name' => "Peserta 4",
            'password' => Hash::make('123'),
            'tanggal_lahir' => now(),
        ]);

        DB::table('users')->insert([
            'email' => "user5@gmail.com",
            'role' => "peserta",
            'name' => "Peserta 5",
            'password' => Hash::make('123'),
            'tanggal_lahir' => now(),
        ]);

        DB::table('users')->insert([
            'email' => "user6@gmail.com",
            'role' => "peserta",
            'name' => "Peserta 6",
            'password' => Hash::make('123'),
            'tanggal_lahir' => now(),
        ]);

        DB::table('users')->insert([
            'email' => "user7@gmail.com",
            'role' => "peserta",
            'name' => "Peserta 7",
            'password' => Hash::make('123'),
            'tanggal_lahir' => now(),
        ]);

        DB::table('users')->insert([
            'email' => "user8@gmail.com",
            'role' => "peserta",
            'name' => "Peserta 8",
            'password' => Hash::make('123'),
            'tanggal_lahir' => now(),
        ]);

        DB::table('users')->insert([
            'email' => "user9@gmail.com",
            'role' => "peserta",
            'name' => "Peserta 9",
            'password' => Hash::make('123'),
            'tanggal_lahir' => now(),
        ]);

        DB::table('users')->insert([
            'email' => "user10@gmail.com",
            'role' => "peserta",
            'name' => "Peserta 10",
            'password' => Hash::make('123'),
            'tanggal_lahir' => now(),
        ]);

        DB::table('users')->insert([
            'email' => "user11@gmail.com",
            'role' => "peserta",
            'name' => "Peserta 11",
            'password' => Hash::make('123'),
            'tanggal_lahir' => now(),
        ]);

        // TRAINER
        DB::table('users')->insert([
            'email' => "rifqi.irfansyah.tif23@polban.ac.id",
            'role' => "pemateri",
            'name' => "Rifqi Irfansyah",
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
            'email' => "rifqi.irfansyah.tif23@polban.ac.id",
            'no_wa' => "08965698171",
            'kemampuan' => "bisa bahasa java",
            'pengalaman' => "1-3 tahun",
            'status_akun' => "Belum direview",
        ]);

        DB::table('tambahan_trainer')->insert([
            'email' => "pemateri2@gmail.com",
            'no_wa' => "08965698171",
            'kemampuan' => "bisa bahasa java",
            'pengalaman' => "belum ada",
            'status_akun' => "Terkonfirmasi",
        ]);

        
    }
}
