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
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nome do Sorteio</th>
                    <th scope="col">Quantidade de sorteios realizados</th>
                    <th scope="col">Ações</th>
                    <th scope="col"></th> {{-- Nova coluna para o botão de e-mail --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($sorteados as $sorteado)
                    <tr>
                        <td>{{ $sorteado->sorteio_id }}</td>
                        <td>{{ $sorteado->sorteio->nome }}</td>
                        <td>{{ $sorteado->quantidade }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Ações">
                                <form method="POST" action="{{ route('sorteio.email', $sorteado->sorteio_id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-info" title="Enviar E-mail">
                                        <i class="fas fa-envelope"></i>
                                    </button>
                                </form>
                                <a href="#" type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#modal-default{{ $sorteado->sorteio_id }}" title="Excluir"
                                    style="margin-left: 5px">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                        </td>

                        {{-- DELETE MODAL --}}
                        <div class="modal fade" id="modal-default{{ $sorteado->sorteio_id }}" style="display: none;"
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
                                        <form method="post" action="{{ route('sorteio.destroy', $sorteado->sorteio_id) }}">
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
