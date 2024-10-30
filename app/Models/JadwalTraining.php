<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalTraining extends Model
{
    use HasFactory;

    protected $table = 'jadwal_training';
    protected $primaryKey = 'id_jadwal';

    protected $fillable = [
        'id_training',
        'status',
        'tempat_pelaksana',
        'topik_pertemuan',
        'waktu_mulai',
        'waktu_selesai',
        'pertemuan_mulai',
        'pertemuan_selesai',
    ];

    public function training()
    {
        return $this->belongsTo(Training::class, 'id_training');
    }

    public function absen(){
        return $this->hasMany(Absen::class, 'id_jadwal');
    }

}                                      
