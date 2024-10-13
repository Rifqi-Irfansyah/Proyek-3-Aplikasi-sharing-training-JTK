<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;

    protected $table = 'absen';

    protected $fillable = [
        'id_jadwal',
        'email',
        'status',
        'updated_at', 
        'created_at'
    ];

    public function jadwal()
    {
        return $this->belongsTo(JadwalTraining::class, 'id_jadwal');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'email');
    }
}
