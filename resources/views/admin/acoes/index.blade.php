@extends('layouts.adminlte')

@section('title', 'Admin - Ações')

@section('content')

<h1>Gerenciar Ações de Extensão</h1>

<a href="{{ route('admin.acoes.create') }}" class="btn btn-success mb-3">
    Nova Ação
</a>

<table class="table dt-responsive nowrap table-bordered">
    <thead>
        <tr>
            <th>Título</th>
            <th>Área</th>
            <th>Título</th>
        </tr>
    </thead>
    <tbody>
        @foreach($acoes as $acao)
        <tr>
            <td>{{ $acao->titulo }}</td>
            <td>{{ $acao->area->nome }}</td>
            <td>
                <a href="{{ route('admin.acoes.edit', $acao->id) }}"
                   class="btn btn-sm btn-warning">Editar</a>

                <form method="POST"
                      action="{{ route('admin.acoes.destroy', $acao->id) }}"
                      style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Excluir</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
