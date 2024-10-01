<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaTraining extends Model
{
    use HasFactory;

    protected $table = 'peserta_training';
    protected $fillable = [
        'id_training',
        'email_peserta',
    ];

    public function training()
    {
        return $this->belongsTo(Training::class, 'email_peserta', 'email');
    }
}
