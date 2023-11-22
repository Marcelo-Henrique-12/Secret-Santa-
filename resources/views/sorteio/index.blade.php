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
                </tr>
            </thead>
            <tbody>
                
                
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
