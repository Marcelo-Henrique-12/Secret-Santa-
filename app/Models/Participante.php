<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Participante extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'email','user_id','status_participante'];

    public function sorteado()
    {
        return $this->hasMany(Sorteado::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function scopeSearch($query, $request)
    {

        return $query->when($request->nome, function ($query, $nome) {
                return $query->where('nome', 'like', '%' . $nome . '%');
            })->when($request->status_participante , function ($query, $status_participante) {
                return $query->where('status_participante', $status_participante);
            });
        }


}
