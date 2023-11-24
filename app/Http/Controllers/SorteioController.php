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

class SorteioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $participantes = Participante::select('id', 'nome', 'email')->get();
        $sorteiosPorAno = Sorteio::selectRaw('ano_sorteio, COUNT(id) as quantidade')->groupBy('ano_sorteio')->get();

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

        $participantesSelecionados = explode(',', $request->participantes_selecionados);

        // Filtra os participantes da tabela 'participantes' com base nos IDs selecionados
        $participantesSelecionados = Participante::whereIn('id', $participantesSelecionados)->get();

        // Garante que há pelo menos dois participantes para fazer o sorteio
        if ($participantesSelecionados->count() < 2) {
            return redirect()->back()->with('error', 'Não há participantes suficientes para fazer o sorteio.');
        }

        // Realiza o sorteio
        $resultado = $this->realizarSorteio($participantesSelecionados, $request->ano);

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
        // Verifica se os participantes já foram sorteados no mesmo ano
        $participantesSorteadosAno = session()->get("participantes_sorteados_$ano", collect());

        // Filtra os participantes que ainda não foram sorteados
        $participantesDisponiveis = $participantes->reject(function ($participante) use ($participantesSorteadosAno) {
            return $participantesSorteadosAno->contains($participante->id);
        });

        // Verifica se há pelo menos dois participantes disponíveis para fazer o sorteio
        if ($participantesDisponiveis->count() < 2) {
            return redirect()->back()->with('error', 'Não há participantes suficientes para fazer o sorteio.');
        }

        // Embaralha os participantes disponíveis
        $participantesEmbaralhados = $participantesDisponiveis->shuffle();

        // Verifica se a coleção não está vazia antes de tentar acessar itens
        if ($participantesEmbaralhados->isNotEmpty()) {
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

                // Adiciona o participante sorteado à lista de participantes sorteados
                $participantesSorteadosAno->push($participante->id);

                // Enviar e-mail para o participante
                $amigoSecreto = Participante::find($amigoSecreto->id);
                Mail::to($participante->email)->send(new SorteioEmail($participante, $amigoSecreto));

                // Remove o participante sorteado da lista de participantes disponíveis
                $participantesEmbaralhados = $participantesEmbaralhados->reject(function ($p) use ($amigoSecreto) {
                    return $p->id === $amigoSecreto->id;
                });
            }

            // Armazena a lista de participantes sorteados na sessão
            session()->put("participantes_sorteados_$ano", $participantesSorteadosAno->toArray());
        } else {
            return redirect()->back()->with('error', 'Não há participantes suficientes para fazer o sorteio.');
        }

        // Retorno adicionado para indicar que o sorteio foi bem-sucedido
        return true;
    }
    public function create()
    {
        $participantes = Participante::select('id', 'nome', 'email')->get();
        $sorteiosPorAno = Sorteio::selectRaw('ano_sorteio, COUNT(id) as quantidade')->groupBy('ano_sorteio')->get();

        return view('sorteio.create', [
            'participantes' => $participantes,
            'sorteiosPorAno' => $sorteiosPorAno,
        ]);
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
     * Enviar e-mails para os participantes do sorteio de um determinado ano.
     */
    public function mailto(string $ano)
    {
        $participantes = Participante::select('id', 'nome', 'email')->get();
        $sorteiosdoAno = Sorteio::where('ano_sorteio', $ano)->get();

        foreach ($participantes as $participante) {
            // Enviar e-mail para o participante
            $sorteio = Sorteio::where('ano_sorteio', $ano)->where('participante_id', $participante->id)->first();
            $amigoSecreto = $sorteio->amigo_secreto_id;
            $amigoSecreto = Participante::find($amigoSecreto);
            Mail::to($participante->email)->send(new SorteioEmail($participante, $amigoSecreto));
        }

        return redirect()->route('sorteio.index')->with('success', 'Emails do sorteio do ano ' . $ano . ' reenviados com sucesso!');
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
