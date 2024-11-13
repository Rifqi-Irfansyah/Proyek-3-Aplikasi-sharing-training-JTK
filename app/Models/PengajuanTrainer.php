<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanTrainer extends Model
{
    use HasFactory;
    protected $table = 'pengajuan_trainer';

    protected $fillable = [
        'id_training',
        'email_trainer',
        'status_pengajuan'
    ];

    public function training()
    {
        return $this->belongsTo(Training::class, 'id_training');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'email_trainer', 'email');
    }
}
