@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Cadastro</h1>
@stop

@section('content')
    <p>Cadastre um novo participante.</p>
    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    <form method="post" action="{{ route('novoparticipante.store') }}" class="row g-3 needs-validation">
        @csrf
        <div class="form-group col-md-6">
            <label for="nome">Nome</label>
            <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome"
                placeholder="Ex.: José da Silva Ribeiro" name="nome">
            <small id="nomeHelp" class="form-text text-muted">Nome Completo</small>

            @error('nome')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group col">
            <label for="email">E-mail</label>
            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp"
                placeholder="Ex.: example@email.com">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12">
            <button class="btn btn-primary" type="submit">Cadastrar participante</button>
        </div>
    </form>


    {{-- LISTAGEM DE PARTICIPANTES --}}




    <div class="listausuarios">
        <h3>Participantes</h3>
        <p>Participantes Cadastrados</p>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">email</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($participantes as $participante)
                    <tr>
                        <th scope="row">{{ $participante->id }}</th>
                        <td>{{ $participante->nome }}</td>
                        <td>{{ $participante->email }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('novoparticipante.edit', $participante->id) }}" type="button"
                                    class="btn btn-info" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                            <div class="btn-group">

                                <a href="#" type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#modal-default{{ $participante->id }}" title="Excluir">
                                    <i class="fas fa-trash-alt"></i>
                                </a>

                            </div>
                        </td>

                        {{-- DELETE MODAL --}}
                        <div class="modal fade" id="modal-default{{ $participante->id }}" style="display: none;"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Excluir participante</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Caso prossiga com a exclusão do item, o mesmo não será mais recuperado. Deseja
                                            realmente excluir?</p>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                        <form method="post" action="{{ route('novoparticipante.destroy', $participante->id) }}">
                                            @method('delete')
                                            @CSRF
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
        .listausuarios {
            margin-top: 100px;
        }
    </style>
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
