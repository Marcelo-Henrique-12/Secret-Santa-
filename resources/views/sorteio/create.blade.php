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
        <div class="form-group col-md-6">
            <label for="nome">Nome do sorteio</label>
            <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" placeholder="Nome do sorteio"
                name="nome">
            <small id="nomeHelp" class="form-text text-muted">Digite o nome do sorteio que será realizado</small>

            @error('nomeSorteio')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="descricao">Descricao do sorteio</label>
            <input type="text" class="form-control @error('descricao') is-invalid @enderror" id="descricao" placeholder="Digite uma descricao para o sorteio"
                name="descricao">
            <small id="descricaoHelp" class="form-text text-muted">Digite o nome do sorteio que será realizado</small>

            @error('descricao')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>



        <div class="form-group">
            <label for="participantes">Participantes disponíveis</label>
            <div class="input-group">
                <input type="text" class="form-control" id="search" placeholder="Pesquise o nome">
            </div>
            <ul class="list-group" id="participantes-list">
                @foreach ($participantes as $participante)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $participante->nome }}
                        <button type="button" class="btn btn-primary btn-sm add-button"
                            data-participante="{{ $participante->id }}">+</button>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="form-group">
            <label for="selected-participantes">Participantes selecionados</label>
            <ul class="list-group" id="selected-participantes">
            </ul>
        </div>

        <input type="hidden" name="participantes_selecionados" id="participantes_selecionados">


        <a href="{{ route('sorteio.index') }}" class="btn btn-outline-primary" role="button">
            Voltar
        </a>
        <button type="submit" class="btn btn-primary" role="button">Sortear nomes</button>
    </form>

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
    <script>
        $(document).ready(function() {
            // Lista de participantes disponíveis
            var participantesDisponiveis = {!! json_encode($participantes) !!};

            // Lista de participantes selecionados
            var participantesSelecionados = [];

            // Atualizar a lista de participantes disponíveis com base na pesquisa
            function updateAvailableList(searchTerm) {
                var filteredParticipantes = filterParticipantes(searchTerm);

                // Limpar a lista existente
                $('#participantes-list').empty();

                // Preencher a lista com participantes filtrados
                filteredParticipantes.forEach(function(participante) {
                    var listItem =
                        '<li class="list-group-item d-flex justify-content-between align-items-center">' +
                        participante.nome +
                        '<button type="button" class="btn btn-primary btn-sm add-button" data-participante="' +
                        participante.id + '">+</button>' +
                        '</li>';
                    $('#participantes-list').append(listItem);
                });
            }
            // Adicionar participante ao clicar no botão de adição
            function addParticipante(participante) {
                // Remover participante da lista de disponíveis
                participantesDisponiveis = participantesDisponiveis.filter(function(p) {
                    return p.id !== participante.id;
                });

                // Adicionar participante à lista de selecionados
                participantesSelecionados.push(participante);

                updateSelectedList();
                updateAvailableList($('#search').val());
                updateHiddenField(); // Adiciona esta chamada para atualizar o campo oculto
            }

            // Atualizar a lista de participantes selecionados
            function updateSelectedList() {
                var ul = $('#selected-participantes');
                ul.empty();

                participantesSelecionados.forEach(function(participante, index) {
                    var listItem =
                        '<li class="list-group-item d-flex justify-content-between align-items-center">' +
                        participante.nome +
                        '<button type="button" class="btn btn-danger btn-sm remove-button" data-index="' +
                        index + '">-</button>' +
                        '</li>';
                    ul.append(listItem);
                });

                updateHiddenField(); // Adiciona esta chamada para atualizar o campo oculto
            }

            // Atualizar o campo oculto com os IDs dos participantes selecionados
            function updateHiddenField() {
                var participantesIds = participantesSelecionados.map(function(participante) {
                    return participante.id;
                });

                $('#participantes_selecionados').val(participantesIds.join(','));
            }

            // Filtrar participantes disponíveis com base na pesquisa por nome
            function filterParticipantes(searchTerm) {
                return participantesDisponiveis.filter(function(participante) {
                    return participante.nome.toLowerCase().includes(searchTerm.toLowerCase());
                });
            }

            // Atualizar a lista de participantes disponíveis ao digitar na barra de pesquisa
            $('#search').on('input', function() {
                var searchTerm = $(this).val();
                updateAvailableList(searchTerm);
            });

            // Adicionar participante ao clicar no botão de adição
            $('#participantes-list').on('click', '.add-button', function() {
                var participanteId = $(this).data('participante');
                var selectedParticipante = participantesDisponiveis.find(function(participante) {
                    return participante.id == participanteId;
                });

                if (selectedParticipante) {
                    addParticipante(selectedParticipante);
                }
            });

            // Remover participante ao clicar no botão de remoção
            $('#selected-participantes').on('click', '.remove-button', function() {
                var index = $(this).data('index');
                var removedParticipante = participantesSelecionados.splice(index, 1)[0];

                // Adicionar participante removido de volta à lista de disponíveis
                participantesDisponiveis.push(removedParticipante);

                updateSelectedList();
                updateAvailableList($('#search').val());
            });
        });
    </script>
@stop
