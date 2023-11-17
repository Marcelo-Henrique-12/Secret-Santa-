<?php

namespace App\Http\Controllers;

use App\Models\Participante;
use Illuminate\Http\Request;

class SorteioController extends Controller
{
    public function index()
    {
        $participantes = Participante::select('id', 'nome', 'email')->get();
        
        return view('sorteio.index', [
            'participantes' => $participantes
        ]);
    }
}
