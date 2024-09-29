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
        'waktu_mulai',
        'waktu_selesai',
        'status',
        'tempat_pelaksana',
    ];

    public function training()
    {
        return $this->belongsTo(Training::class, 'id_training');
    }

}
