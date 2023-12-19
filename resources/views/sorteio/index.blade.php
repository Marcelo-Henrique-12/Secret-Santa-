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
        <h3>Sorteios</h3>
        <p>Sorteios realizados</p>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nome do Sorteio</th>
                        <th scope="col">Quantidade de participantes</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sorteios as $sorteio)
                        <tr>
                            <td>{{ $sorteio->id }}</td>
                            <td>{{ $sorteio->nome }}</td>
                            <td>{{ $sorteio->quantidadeParticipantes() }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Ações">
                                    <form method="POST" action="{{ route('sorteio.email', $sorteio->id) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-info" data-toggle="tooltip"
                                            data-placement="top" title="Enviar E-mail">
                                            <i class="fas fa-envelope"></i>
                                        </button>
                                    </form>
                                </div>

                                <div class="btn-group" role="group" aria-label="Ações">
                                    <form method="GET" action="{{ route('sorteio.show', $sorteio->id) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-info" data-toggle="tooltip"
                                            data-placement="top" title="Visualizar sorteio" style="margin-left: 5px">
                                            <i class="far fa-eye"></i>
                                        </button>
                                    </form>
                                </div>

                                <div class="btn-group" role="group" aria-label="Ações">
                                    <a href="#" type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#modal-default{{ $sorteio->id }}" data-placement="top" title="Excluir"
                                        style="margin-left: 5px">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        {{-- DELETE MODAL --}}
                        <div class="modal fade" id="modal-default{{ $sorteio->id }}" style="display: none;"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Excluir o sorteio!</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Após a exlusão não haverá como recuperar. Deseja realmente excluir?</p>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                        <form method="post" action="{{ route('sorteio.destroy', $sorteio->id) }}">
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
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
        .lista {
            margin-top: 2em;
        }
    </style>
@stop

@section('js')

@stop
