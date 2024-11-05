<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usulan extends Model
{
    use HasFactory;
    protected $table = 'usulan';

    protected $fillable = [
        'judul_materi',
        'bahasan',
        'email_pengusul',
        'usulan',
    ];
}
