<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Participante extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'email'];

    public function sorteado()
    {
        return $this->hasMany(Sorteado::class);
    }

}
