@extends('adminlte::page')

@section('title', 'Participantes')

@section('content_header')
    <h1>Cadastro</h1>
@stop

@section('content')
    <div class="card card-secondary mb-5">
        <p>Cadastre um novo participante.</p>
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif


        <div class="col-12">
            <a href="{{ route('participante.create') }}" class="btn btn-primary" type="submit"><i class="fas fa-plus"></i>
                Cadastrar
                participante</a>
        </div>

    </div>

    <!-- Início Pesquisa -->
    <div class="card card-secondary">

        <h3>Pesquisar</h3>

        <form id="search-form" action="{{ route('participante.index') }}">


            <div class="row">

                <div class="col-md-6 form-group">
                    <label for="nome">Nome do Participante</label>
                    <input type="search" class="form-control" id="textfield1" name="nome"
                        value="{{ request()->nome ?? '' }}" placeholder="Nome do Participante">
                </div>
                <div class="col-md-6 form-group">
                    <label for="status_participante">Status do Participante</label>
                    <select class="form-control" id="status_participante" name="status_participante">
                        <option value="">-- Selecione --</option>
                        <option value="ATIVO" {{ request()->status_participante === 'ATIVO' ? 'selected' : '' }}>Ativo
                        </option>
                        <option value="INATIVO" {{ request()->status_participante === 'INATIVO' ? 'selected' : '' }}>
                            Inativo</option>
                    </select>
                </div>




            </div>

            <div class="card-footer">
                <div class="d-flex justify-content-end gap-3">
                    <a class="btn btn-outline-danger float-right" href="{{ route('participante.index') }}"
                        style="margin-right: 10px;"><i class="fas fa-times"></i> Limpar Campos</a>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i>Pesquisar</button>
                </div>
            </div>
        </form>
    </div>

    {{-- LISTAGEM DE PARTICIPANTES --}}



    <div class="listausuarios table-responsive">
        <h3>Participantes</h3>
        <p>Meus Participantes Cadastrados</p>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">email</th>
                    <th scope="col">status</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($participantes as $participante)
                    <tr>
                        <th scope="row">{{ $participante->id }}</th>
                        <td>{{ $participante->nome }}</td>
                        <td>{{ $participante->email }}</td>
                        <td>{{ $participante->status_participante }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('participante.edit', $participante->id) }}" type="button"
                                    class="btn btn-info" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                            <div class="btn-group">
                                @if ($participante->status_participante === 'ATIVO')
                                    <a href="#" type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#modal-default{{ $participante->id }}" title="Desativar">
                                        <i class="fas fa-ban"></i>
                                    </a>
                                @elseif ($participante->status_participante === 'INATIVO')

                                    <a href="{{ route('participante.reativar', $participante->id) }}" type="button" class="btn btn-success" title="Reativar">
                                        <i class="fas fa-check"></i>
                                    </a>
                                @endif
                            </div>
                        </td>

                        {{-- DELETE MODAL --}}
                        <div class="modal fade" id="modal-default{{ $participante->id }}" style="display: none;"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Desativar participante</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>O participante será desativado, e o mesmo não aparecerá em nenhum novo sorteio.
                                            Deseja mesmo desativá-lo ?</p>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                        <form method="post"
                                            action="{{ route('participante.desativar', $participante->id) }}">
                                            @method('delete')
                                            @CSRF
                                            <input type="hidden" name="rota" value="{{ Route::currentRouteName() }}">
                                            <button type="submit" class="btn btn-danger">Desativar</button>
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
