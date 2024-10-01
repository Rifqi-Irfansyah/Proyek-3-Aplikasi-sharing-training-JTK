<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    use HasFactory;

    protected $table = 'modul';
    protected $primaryKey = 'nama_file';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'nama_file',
        'judul',
    ];

    public function training()
    {
        return $this->hasMany(User::class, 'nama_file');
    }
}
