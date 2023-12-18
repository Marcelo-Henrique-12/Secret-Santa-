@extends('adminlte::page')

@section('title', 'Sorteio')

@section('content_header')
    <h1>Sortear nomes</h1>
@stop

@section('content')


    <div class="form-group col-md-6">
        <label for="nome">Nome do sorteio</label>
        <div type="text" class="form-control @error('nome') is-invalid @enderror" id="nome"
            placeholder="Nome do sorteio" name="nome">
            {{ $sorteio->nome }}
        </div>

    </div>

    <div class="form-group mb-5">
        <label for="descricao">Descricao do sorteio</label>
        <input type="text" class="form-control @error('descricao') is-invalid @enderror" id="descricao"
            placeholder="Digite uma descricao para o sorteio" name="descricao" value="{{ $sorteio->descricao }}" disabled>

    </div>
    <div class="table-responsive">
        <label for="descricao">Participantes</label>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Id do participante</th>
                    <th scope="col">Nome do Participante</th>
                    <th scope="col">E-mail participante</th>
                </tr>

            </thead>
            <tbody>
                @foreach ($sorteados as $sorteado)
                    <tr>
                        <td>{{ $sorteado->participante_id }}</td>
                        <td>{{ $sorteado->participante->nome }}</td>
                        <td>{{ $sorteado->participante->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>


    </div>
    <a href="{{ route('sorteio.index') }}" class="btn btn-outline-primary" role="button">
        Voltar
    </a>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
        .lista {
            margin-top: 100px;
        }

        .input-group {
            margin-bottom: 10px;
        }

        .add-button {
            margin-left: 10px;
        }
    </style>
@stop

@section('js')
@stop
