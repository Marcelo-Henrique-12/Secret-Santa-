@extends('adminlte::page')

@section('title', 'Bem-vindo')

@section('content_header')
    <div class="d-flex flex-column align-items-center mb-5">
        <h1 class="display-6">Bem-vindo!</h1>
    </div>
@stop

@section('content')
    <div class="d-flex flex-column align-items-center">
        <ul class="list-unstyled text-center">
            <li class="lead">Cadastre os participantes!</li>
            <li class="lead">Envio de quem foi o amigo secreto de cada um por email!</li>
        </ul>


    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
        video {
            outline: none;
        }

        video::-webkit-media-controls {
            display: none !important;
        }

        video::-webkit-media-controls-play-button,
        video::-webkit-media-controls-panel {
            display: none !important;
        }

        video::-webkit-media-controls-play-button {
            opacity: 0 !important;
            pointer-events: none !important;
        }

        video:hover::-webkit-media-controls,
        video::-webkit-media-controls-start-playback-button {
            display: none !important;
        }
    </style>
@stop

@section('js')


@stop
