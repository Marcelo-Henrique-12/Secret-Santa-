@extends('adminlte::page')

@section('title', 'Dashboard')

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
