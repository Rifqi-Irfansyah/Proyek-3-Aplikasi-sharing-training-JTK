<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    protected $table = 'training';
    protected $primaryKey = 'id_training';

    public function jadwalTrainings()
    {
        return $this->hasMany(JadwalTraining::class, 'id_training');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'email_trainer', 'email');
    }

    public function modul()
    {
        return $this->hasMany(ModulTraining::class, 'id_training');
    }

    public function peserta()
    {
        return $this->hasMany(PesertaTraining::class, 'id_training');
    }

    public function PengajuanTrainer()
    {
        return $this->hasMany(PengajuanTrainer::class, 'id_training');
    }

}
