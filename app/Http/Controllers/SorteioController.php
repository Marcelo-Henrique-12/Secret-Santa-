<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participante;
use App\Models\Sorteio;
use Illuminate\Support\Collection;

class SorteioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $participantes = Participante::select('id', 'nome', 'email')->get();
        $sorteio = Sorteio::select('id', 'participante_id', 'amigo_secreto_id')->get();

        return view('sorteio.index', [
            'participantes' => $participantes,
            'sorteio' => $sorteio
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        // Obtém os participantes da tabela 'participantes'
        $participantes = Participante::select('id', 'nome', 'email')->get();

        // Garante que há pelo menos dois participantes para fazer o sorteio
        if ($participantes->count() < 2) {
            return redirect()->back()->with('error', 'Não há participantes suficientes para fazer o sorteio.');
        }

        // Realiza o sorteio
        $resultado = $this->realizarSorteio($participantes);

        if ($resultado) {
            return redirect()->route('sorteio.index')->with('success', 'Sorteio realizado com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Não foi possível realizar o sorteio.');
        }
    }

    /**
     * Função para realizar o sorteio.
     */
    private function realizarSorteio(Collection $participantes)
    {
        do {
            // Embaralha os participantes
            $participantesEmbaralhados = $participantes->shuffle();

            // Cria os registros na tabela 'sorteios'
            foreach ($participantes as $index => $participante) {
                // Obtém um índice aleatório dentro do intervalo do count dos participantes
                $amigoSecretoIndex = $participantesEmbaralhados->keys()->random();

                // Obtém o participante correspondente ao índice aleatório
                $amigoSecreto = $participantesEmbaralhados->get($amigoSecretoIndex);

                // Verifica se ao menos uma pessoa se tirou a si mesma ou a mesma pessoa foi tirada duas vezes
                if ($participante->id == $amigoSecreto->id || $participante->jaFoiTirado()) {
                    // Reinicia o sorteio
                    continue 2;
                }

                // Cria o registro na tabela 'sorteios'
                $sorteio = new Sorteio([
                    'participante_id' => $participante->id,
                    'amigo_secreto_id' => $amigoSecreto->id,
                ]);

                $sorteio->save();

                // Marca o participante como já tendo sido tirado para evitar ser sorteado novamente
                $participante->marcarComoTirado();
            }

            // Se chegou até aqui, o sorteio foi concluído com sucesso
            return true;

        } while (true); // Repete o sorteio até que um sorteio bem-sucedido seja alcançado
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
    public function destroy(string $id)
    {
        //
    }
}
