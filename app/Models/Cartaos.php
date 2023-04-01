<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cartaos extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome', 'valor', 'ultima_recarga'
    ];

    protected $table = 'cartaos';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function viagem()
    {
        return $this->hasMany(Viagem::class);
    }
}
