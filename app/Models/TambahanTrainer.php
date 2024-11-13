<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TambahanTrainer extends Model
{
    use HasFactory;

    protected $table = 'tambahan_trainer';
    protected $nonPrimaryKey = 'email';
    protected $fillable = [
        'email',
        'no_wa',
        'kemampuan',
        'pengalaman',
        'status_akun',
        'status_login'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }
}
