<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

     // Gunakan email sebagai kunci utama
     protected $primaryKey = 'email';
     public $incrementing = false;
     protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'role',
        'name',
        'gender',
        'tanggal_lahir',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tambahanTrainer()
    {
        return $this->hasOne(TambahanTrainer::class, 'email', 'email'); // Sesuaikan field relasinya
    }

    public function trainings()
    {
        return $this->hasMany(Training::class, 'email', 'email_trainer');
    }
}
