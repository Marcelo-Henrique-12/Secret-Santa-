<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreParticipanteRequest;
use App\Models\Participante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NovoParticipanteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $participantes = Participante::where('user_id', $user->id)->get();

        return view('participantes.cadastro', [
            'participantes' => $participantes,
            'user' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $user = Auth::user();

        $participantes = Participante::where('user_id', $user->id)->get();



        return view('participantes.cadastro', [
            'participantes' => $participantes,
            'user' => $user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(StoreParticipanteRequest $request)
    {
        $participante = Participante::create($request->validated());

        return redirect()
            ->route('novoparticipante.create')
            ->with([
                'participante' => $participante,
                'success' => 'Participante cadastrado com sucesso!'
            ])
            ->withInput(); // Adiciona os dados antigos à sessão
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
        $participante = Participante::where('id', $id)->first();

        return view('participantes.edit', ['participante' => $participante]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Valide os dados do formulário conforme necessário

        $participante = Participante::findOrFail($id); // Busque o participante pelo ID

        // Atualize os campos do participante com os dados do formulário
        $participante->update([
            'nome' => $request->input('nome'),
            'email' => $request->input('email'),
            // Adicione outros campos conforme necessário
        ]);

        return redirect()
            ->route('novoparticipante.create')
            ->with([
                'participante' => $participante,
                'success' => 'Participante atualizado com sucesso!'
            ])
            ->withInput();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $participante = Participante::findOrFail($id);
        $participante->delete();

        return redirect()->route('novoparticipante.create')->with('success', 'Participante excluído com sucesso!');
    }
}
