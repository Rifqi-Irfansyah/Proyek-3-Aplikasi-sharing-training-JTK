<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModulTraining extends Model
{
    use HasFactory;

    protected $table = 'modul';

    public function training()
    {
        return $this->belongsTo(User::class, 'id_training');
    }

    public function modul()
    {
        return $this->belongsTo(Modul::class, 'nama_file');
    }
}
