@extends('adminlte::page')

@section('title', 'Cadastrar Participantes')

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

        <input type="hidden" name="user_id" value="{{ $user->id }}" id="user_id" aria-describedby="userHelp">



        <div class="col-12">
            <a href="{{ route('novoparticipante.index') }}" class="btn btn-primary" role="button">
                Voltar
            </a>
            <button class="btn btn-primary" type="submit">Cadastrar participante</button>
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

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
