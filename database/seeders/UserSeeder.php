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
        DB::table('users')->insert([
            'email' => "admin@gmail.com",
            'role' => "admin",
            'name' => "Rifqi Irfansyah",
            'password' => Hash::make('123'),
        ]);

        DB::table('users')->insert([
            'email' => "pemateri@gmail.com",
            'role' => "pemateri",
            'name' => "Pemateri 1",
            'password' => Hash::make('123')
        ]);

        DB::table('training')->insert([
            // 'email_trainer' => "pemateri@gmail.com",
            'judul_training' => "Belajar PHP",
            'kuota' => 30,
            'deskripsi' => "Belajar PHP dmdmdm amdamda",
            'status' => "Pendaftaran"
        ]);
    }
}
