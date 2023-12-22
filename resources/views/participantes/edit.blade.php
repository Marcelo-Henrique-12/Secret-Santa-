@extends('adminlte::page')

@section('title', 'Editar Participantes')

@section('content_header')
    <h1>Editar Cadastro</h1>
@stop

@section('content')

    <p>Edite o cadastro de um participante.</p>
    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    <form method="post" action="{{ route('participante.update', ['participante' => $participante->id]) }}" class="row g-3 needs-validation">
        @csrf
        @method('PUT')

        <div class="form-group col-md-6">
            <label for="nome">Nome</label>
            <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome"
                placeholder="Ex.: José da Silva Ribeiro" name="nome" value="{{$participante->nome}}">
            <small id="nomeHelp" class="form-text text-muted">Nome Completo</small>

            @error('nome')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group col">
            <label for="email">E-mail</label>
            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp"
                placeholder="Ex.: example@email.com" value="{{$participante->email}}" >
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12">
            <button class="btn btn-primary" type="submit">Cadastrar participante</button>
            <a href="{{ route('participante.index') }}" class="btn btn-secondary ">Voltar</a>
        </div>
    </form>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
        .listausuarios {
            margin-top: 100px;
        }
    </style>
@stop

