<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome', 'valor', 'id_usuario', 'descricao', 'data'
    ];

    protected $table = 'entradas';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
