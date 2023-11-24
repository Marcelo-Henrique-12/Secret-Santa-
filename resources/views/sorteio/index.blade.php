@extends('adminlte::page')

@section('title', 'Sorteio')

@section('content_header')
    <h1>Sortear nomes</h1>
@stop

@section('content')

    <p>Sorteie os nomes do amigo oculto.</p>
    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif


    <form method="POST" action="{{ route('sorteio.store') }}">
        @csrf
        <div class="form-group col-md-6">
            <label for="ano">Ano da Campanha</label>
            <input type="text" class="form-control @error('ano') is-invalid @enderror" id="ano" placeholder="Ex. 2023"
                name="ano">
            <small id="nomeHelp" class="form-text text-muted">Digite o ano que será realizado o sorteio</small>

            @error('ano')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary" role="button">Sortear nomes</button>
    </form>


    {{-- Sorteios Realizados --}}

    <div class="lista">
        <h3>Campanhas</h3>
        <p>Sorteios realizados</p>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Campanha</th>
                    <th scope="col">Ações</th>
                    <th scope="col"></th> {{-- Nova coluna para o botão de e-mail --}}
                </tr>
            </thead>
            <tbody>
                @php
                    $cont = 1;
                @endphp
                @foreach ($sorteiosPorAno as $sorteio)
                    <tr>
                        <th scope="row">{{ $cont }}</th>
                        <td>{{ $sorteio->ano_sorteio }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Ações">
                                <form method="post" action="{{ route('sorteio.destroy', $sorteio->ano_sorteio) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger" title="Excluir Sorteios do Ano">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('sorteio.email', $sorteio->ano_sorteio) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-info" style="margin-left:5px;"title="Enviar E-mail">
                                        <i class="fas fa-envelope"></i>
                                    </button>
                                </form>
                               
                            </div>
                        </td>


                    </tr>
                    @php
                        $cont++;
                    @endphp
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- LISTAGEM DE PARTICIPANTES --}}

    <div class="lista">
        <h3>Participantes</h3>
        <p>Participantes Cadastrados</p>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">email</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($participantes as $participante)
                    <tr>
                        <th scope="row">{{ $participante->id }}</th>
                        <td>{{ $participante->nome }}</td>
                        <td>{{ $participante->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>


    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
        .lista {
            margin-top: 100px;
        }
    </style>
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
