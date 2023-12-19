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
        'descricao',
        'user_id'
    ];

    public function sorteado()
    {
        return $this->belongsTo(Sorteado::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function quantidadeParticipantes()
    {
        return Sorteado::where('sorteio_id', $this->id)->count();
    }
}
