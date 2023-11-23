<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participante;
use App\Models\Sorteio;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Collection;
use App\Http\Requests\StoreSorteioRequest;

class SorteioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $participantes = Participante::select('id', 'nome', 'email')->get();
        $sorteiosPorAno = Sorteio::select('id', 'ano_sorteio')->distinct()->get();

        return view('sorteio.index', [
            'participantes' => $participantes,
            'sorteiosPorAno' => $sorteiosPorAno,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSorteioRequest $request)
    {   
        
        // Verifica se já existe um sorteio para o ano fornecido
        $sorteioExistente = Sorteio::where('ano_sorteio', $request->ano)->exists();

        if ($sorteioExistente) {
            return redirect()->back()->with('error', 'Já foi realizado um sorteio para o ano informado.');
        }

        // Obtém os participantes da tabela 'participantes'
        $participantes = Participante::select('id', 'nome', 'email')->get();

        // Garante que há pelo menos dois participantes para fazer o sorteio
        if ($participantes->count() < 2) {
            return redirect()->back()->with('error', 'Não há participantes suficientes para fazer o sorteio.');
        }

        // Realiza o sorteio
        $resultado = $this->realizarSorteio($participantes, $request->ano);

        if ($resultado) {
            return redirect()->route('sorteio.index')->with('success', 'Sorteio realizado com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Não foi possível realizar o sorteio.');
        }
    }

    /**
     * Função para realizar o sorteio.
     */
    private function realizarSorteio(Collection $participantes, $ano)
    {   
    
        // Obtém os IDs dos participantes que já foram sorteados    
        $participantesSorteados = Sorteio::pluck('amigo_secreto_id');

        // Filtra os participantes que ainda não foram sorteados
        $participantesDisponiveis = $participantes->reject(function ($participante) use ($participantesSorteados) {
            return $participantesSorteados->contains($participante->id);
        });

        // Embaralha os participantes disponíveis
        $participantesEmbaralhados = $participantesDisponiveis->shuffle();

        // Cria os registros na tabela 'sorteios'
        foreach ($participantes as $index => $participante) {
            // Obtém um participante disponível aleatório
            $amigoSecreto = $participantesEmbaralhados->random();

            while ($amigoSecreto->id === $participante->id) {
                $amigoSecreto = $participantesEmbaralhados->random();
            }

            $sorteio = new Sorteio([
                'participante_id' => $participante->id,
                'amigo_secreto_id' => $amigoSecreto->id,
                'ano_sorteio' => $ano
            ]);

            $sorteio->save();

            // Remove o participante sorteado da lista de participantes disponíveis
            $participantesEmbaralhados = $participantesEmbaralhados->reject(function ($p) use ($amigoSecreto) {
                return $p->id === $amigoSecreto->id;
            });
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $ano)
    {
        Sorteio::where('ano_sorteio', $ano)->delete();
        return redirect()->route('sorteio.index')->with('success', 'Sorteios do ano ' . $ano . ' excluídos com sucesso!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
   
}
