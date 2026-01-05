@extends('layouts.adminlte')

@section('title', $acao->titulo)

@section('content')

<h2>{{ $acao->titulo }}</h2>

<div class="card">
    <div class="card-body">

        <p><strong>Área:</strong> {{ $acao->area->nome }}</p>
        <p><strong>Responsável:</strong> {{ $acao->responsavel }}</p>
        <p><strong>Local:</strong> {{ $acao->local }}</p>
        <p><strong>Período:</strong>
            {{ $acao->data_inicio }} a {{ $acao->data_fim }}
        </p>

        <hr>

        <p>{{ $acao->descricao }}</p>

        <a href="/" class="btn btn-secondary mt-3">Voltar</a>
    </div>
</div>

@endsection
