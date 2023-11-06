<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome', 'descricao', 'data'
    ];

    protected $table = 'agendamentos';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
