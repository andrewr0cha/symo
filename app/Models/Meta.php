<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome', 'descricao', 'valor', 'status', 'duracao'
    ];

    protected $table = 'metas';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
