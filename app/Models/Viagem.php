<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Viagem extends Model
{
    use HasFactory;
    protected $fillable = [
        'valor', 'id_cartao', 'data'
    ];

    protected $table = 'viagems';

    public function cartao()
    {
        return $this->belongsTo(Cartaos::class);
    }
}
