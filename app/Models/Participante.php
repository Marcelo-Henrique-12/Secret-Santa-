<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Participante extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'email'];

    /**
     * Verifica se o participante já foi sorteado.
     */
    public function jaFoiTirado()
    {
        return Sorteio::where('participante_id', $this->id)->exists();
    }

    /**
     * Marca o participante como já tendo sido tirado.
     */
    public function marcarComoTirado()
    {
        // Adapte conforme necessário para a lógica do seu aplicativo
        // Por exemplo, você pode querer registrar os sorteios em uma tabela 'sorteios'
        Sorteio::create([
            'participante_id' => $this->id,
            'amigo_secreto_id' => $this->id,
        ]);
    }
}
