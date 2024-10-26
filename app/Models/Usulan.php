<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usulan extends Model
{
    use HasFactory;
    protected $table = 'usulan'; // Pastikan ini

    protected $fillable = [
        'judul_materi',
        'bahasan',
        'email_pengusul',
        'usulan',
        'status',
    ];
}
