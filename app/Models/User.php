<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'usuario', 'saldo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $table = 'users';

    public function cartao()
    {
        return $this->hasMany(Cartaos::class);
    }

    public function saida()
    {
        return $this->hasMany(Saida::class);
    }
    
    public function entrada()
    {
        return $this->hasMany(Entrada::class);
    }

    public function meta()
    {
        return $this->hasMany(Meta::class);
    }

    public function agendamento()
    {
        return $this->hasMany(Agendamento::class);
    }

    public function simulacao()
    {
        return $this->hasMany(Simulacao::class);
    }
}
