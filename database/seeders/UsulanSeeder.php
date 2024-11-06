<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsulanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usulan')->insert([
            'judul_materi' => "Pemrograman Mobile",
            'bahasan' => "Saya ingin adanya pelatihan Mobile menggunakan Flutter",
            'email_pengusul' => "user1@gmail.com",
        ]);

        DB::table('usulan')->insert([
            'judul_materi' => "Pemrograman AI",
            'bahasan' => "Saya ingin adanya pelatihan AI",
            'email_pengusul' => "user2@gmail.com",
        ]);
    }
}
