@extends('layouts.adminlte')

@section('title', 'Ações de Extensão')

@section('content')

<h1 class="mb-4">Ações de Extensão</h1>

<form method="GET" class="row mb-4">
    <div class="col-md-4">
        <input type="text" name="busca" class="form-control"
               placeholder="Buscar por palavra-chave"
               value="{{ request('busca') }}">
    </div>

    <div class="col-md-3">
        <select name="area" class="form-control">
            <option value="">Todas as áreas</option>
            @foreach($areas as $area)
                <option value="{{ $area->id }}"
                    {{ request('area') == $area->id ? 'selected' : '' }}>
                    {{ $area->nome }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <button class="btn btn-primary">Filtrar</button>
    </div>
</form>

<table class="table dt-responsive nowrap table-bordered table-hover">
    <thead>
        <tr>
            <th>Título</th>
            <th>Área</th>
            <th>Local</th>
            <th>Período</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($acoes as $acao)
        <tr>
            <td>{{ $acao->titulo }}</td>
            <td>{{ $acao->area->nome }}</td>
            <td>{{ $acao->local }}</td>
            <td>
                {{ $acao->data_inicio }} a {{ $acao->data_fim }}
            </td>
            <td>
                <a href="/acoes/{{ $acao->id }}" class="btn btn-sm btn-info">
                    Ver detalhes
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
