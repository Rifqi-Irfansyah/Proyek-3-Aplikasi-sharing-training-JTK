<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PesertaTraining extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('peserta_training')->insert([
            'id_training' => 1,
            'email_peserta' => "user1@gmail.com",
        ]);

        DB::table('peserta_training')->insert([
            'id_training' => 1,
            'email_peserta' => "user2@gmail.com",
        ]);

        DB::table('peserta_training')->insert([
            'id_training' => 1,
            'email_peserta' => "user3@gmail.com",
        ]);

        DB::table('peserta_training')->insert([
            'id_training' => 1,
            'email_peserta' => "user4@gmail.com",
        ]);

        DB::table('peserta_training')->insert([
            'id_training' => 1,
            'email_peserta' => "user5@gmail.com",
        ]);

        DB::table('peserta_training')->insert([
            'id_training' => 1,
            'email_peserta' => "user6@gmail.com",
        ]);

        DB::table('peserta_training')->insert([
            'id_training' => 1,
            'email_peserta' => "user7@gmail.com",
        ]);

        DB::table('peserta_training')->insert([
            'id_training' => 1,
            'email_peserta' => "user8@gmail.com",
        ]);

        DB::table('peserta_training')->insert([
            'id_training' => 1,
            'email_peserta' => "user9@gmail.com",
        ]);

        DB::table('peserta_training')->insert([
            'id_training' => 1,
            'email_peserta' => "user10@gmail.com",
        ]);

        DB::table('peserta_training')->insert([
            'id_training' => 1,
            'email_peserta' => "admin@gmail.com",
        ]);
    }
}
