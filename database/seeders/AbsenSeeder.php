<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Absen;


class AbsenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<=3; $i++){
            DB::table('absen')->insert([
                'id_jadwal' => $i,
                'email' => "admin@gmail.com",
                'status' => "Tidak Hadir"
            ]);
            
            for($j=1; $j<=10; $j++){
                DB::table('absen')->insert([
                    'id_jadwal' => $i,
                    'email' => "user{$j}@gmail.com",
                    'status' => "Tidak Hadir"
                ]);
            }
        }
    }
}
