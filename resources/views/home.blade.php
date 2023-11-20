@extends('adminlte::page')

@section('title', 'Bem vindo')

@section('content_header')
    <h1>Bem vindo</h1>
@stop

@section('content')
    <p>Cadastre os participantes do amigo oculto e os sorteie.</p>
    <br>
    <p>Envio de quem foi o amigo oculto de cada um por email!</p>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop