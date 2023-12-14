<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sorteio extends Model
{
    use HasFactory;

    protected $table = 'sorteios';

    protected $fillable = [
        'nome',
        'descricao'
    ];

    public function sorteado()
    {
        return $this->belongsTo(Sorteado::class);
    }
}
