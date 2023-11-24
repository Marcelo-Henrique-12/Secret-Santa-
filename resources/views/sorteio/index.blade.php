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

    <a href="{{ route('sorteio.create') }}" class="btn btn-primary" role="button">
        <i class="fas fa-plus"></i> Criar Novo Sorteio
    </a>


    {{-- Sorteios Realizados --}}
    <div class="lista">
        <h3>Campanhas</h3>
        <p>Sorteios realizados</p>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Quantidade de sorteios realizados</th>
                    <th scope="col">Ano da realização</th>
                    <th scope="col">Ações</th>
                    <th scope="col"></th> {{-- Nova coluna para o botão de e-mail --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($sorteiosPorAno as $sorteio)
                    <tr>
                        <td>{{ $sorteio->quantidade }}</td>
                        <td>{{ $sorteio->ano_sorteio }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Ações">
                                <form method="POST" action="{{ route('sorteio.email', $sorteio->ano_sorteio) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-info" title="Enviar E-mail">
                                        <i class="fas fa-envelope"></i>
                                    </button>
                                </form>
                                <a href="#" type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#modal-default{{ $sorteio->ano_sorteio }}" title="Excluir"
                                    style="margin-left: 5px">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                        </td>

                        {{-- DELETE MODAL --}}
                        <div class="modal fade" id="modal-default{{ $sorteio->ano_sorteio }}" style="display: none;"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Excluir o sorteio deste ano!</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Todos os sorteios deste ano serão cancelados. Deseja realmente excluir?</p>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                        <form method="post" action="{{ route('sorteio.destroy', $sorteio->ano_sorteio) }}">
                                            @method('delete')
                                            @csrf
                                            <input type="hidden" name="rota" value="{{ Route::currentRouteName() }}">
                                            <button type="submit" class="btn btn-danger">Excluir</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- DELETE MODAL --}}
                    </tr>
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
