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

        DB::table('materi')->insert([
            'email_pemateri' => "pemateri@gmail.com",
            'judul_materi' => "Belajar PHP",
            'judul_materi' => "Belajar PHP",
            'status' => "Terkirim"
        ]);
    }
}
