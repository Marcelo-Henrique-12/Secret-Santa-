<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participante;
use App\Models\Sorteio;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Collection;
use App\Http\Requests\StoreSorteioRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\SorteioEmail;
use App\Models\Sorteado;
use Illuminate\Support\Facades\DB;

class SorteioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $participantes = Participante::select('id', 'nome', 'email')->get();
        $sorteados = Sorteado::selectRaw('sorteio_id, COUNT(id) as quantidade')->groupBy('sorteio_id')->get();

        return view('sorteio.index', [
            'participantes' => $participantes,
            'sorteados' => $sorteados,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSorteioRequest $request)
    {
        $participantesSelecionados = explode(',', $request->participantes_selecionados);

        $participantesSelecionados = Participante::whereIn('id', $participantesSelecionados)->get();

        if ($participantesSelecionados->count() < 2) {
            return redirect()->back()->with('error', 'Não há participantes suficientes para fazer o sorteio.');
        }

        
        DB::transaction(function () use ($request, $participantesSelecionados) {
            $dados = $request->validated();
            $sorteio = Sorteio::create($dados);

            $participantesEmbaralhados = $participantesSelecionados->shuffle();

            if ($participantesEmbaralhados->isNotEmpty()) {
                foreach ($participantesSelecionados as $participante) {
                    // Garante que o participante não tire a si mesmo
                    $amigoSecreto = $participantesEmbaralhados->reject(function ($amigo) use ($participante) {
                        return $amigo->id === $participante->id;
                    })->first();

                    if ($amigoSecreto) {
                        // Verificar se já existe um registro com o mesmo sorteio_id e amigo_secreto_id
                        $registroExistente = Sorteado::where('sorteio_id', $sorteio->id)
                            ->where('amigo_secreto_id', $amigoSecreto->id)
                            ->exists();

                        if (!$registroExistente) {
                            $sorteados = new Sorteado([
                                'participante_id' => $participante->id,
                                'amigo_secreto_id' => $amigoSecreto->id,
                                'sorteio_id' => $sorteio->id
                            ]);

                            $sorteados->save();

                            // Enviar e-mail para o participante
                            Mail::to($participante->email)->send(new SorteioEmail($participante, $amigoSecreto));

                            // Remover o amigo secreto da lista para evitar repetição
                            $participantesEmbaralhados = $participantesEmbaralhados->reject(function ($amigo) use ($amigoSecreto) {
                                return $amigo->id === $amigoSecreto->id;
                            });
                        }
                    }
                }
            } else {
                return redirect()->back()->with('error', 'Não há participantes suficientes para fazer o sorteio.');
            }
        });

        return redirect()->route('sorteio.index')->with('success', 'Sorteio realizado com sucesso!');
    }




    public function create()
    {
        $participantes = Participante::select('id', 'nome', 'email')->get();

        return view('sorteio.create', [
            'participantes' => $participantes
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($sorteio_id)
    {
        Sorteado::where('sorteio_id', $sorteio_id)->delete();
        Sorteio::where('id', $sorteio_id)->delete();
        return redirect()->route('sorteio.index')->with('success', 'Sorteio excluído com sucesso!');
    }

    /**
     * Enviar e-mails para os participantes do sorteio de um determinado ano.
     */
    public function mailto($sorteio_id)
    {
        $sorteados = Sorteado::where('sorteio_id', $sorteio_id)->get();

        $sorteio = Sorteio::where('id', $sorteio_id)->first();

        foreach ($sorteados as $sorteado) {

            // Enviar e-mail para o participante
            $participante = Participante::where('id', $sorteado->participante_id)->first();
            $amigoSecreto = Participante::where('id', $sorteado->amigo_secreto_id)->first();

            Mail::to($participante->email)->send(new SorteioEmail($participante, $amigoSecreto));
        }

        return redirect()->route('sorteio.index')->with('success', 'Emails do sorteio ' . $sorteio->nome . ' reenviados com sucesso!');
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
