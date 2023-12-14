<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sorteado extends Model
{
    use HasFactory;

    protected $table = 'sorteados';

    protected $fillable = [
        'participante_id',
        'amigo_secreto_id',
        'sorteio_id'
    ];

    public function sorteio()
    {
        return $this->belongsTo(Sorteio::class);
    }

    public function amigoSecreto()
    {
        return $this->belongsTo(Sorteio::class);
    }

    public function participante()
    {
        return $this->belongsTo(Sorteio::class);
    }
}
