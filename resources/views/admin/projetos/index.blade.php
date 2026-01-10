@extends('layouts.adminlte')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Projetos de Extensão</h3>
            <div class="card-tools">
                <a href="{{ route('admin.projetos.create') }}" class="btn btn-primary btn-sm">
                    Novo Projeto
                </a>
            </div>
        </div>

        <div class="card-body table-responsive">
            <table class="table dt-responsive nowrap table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Área</th>
                        <th>Local</th>
                        <th>Coordenador</th>
                        <th width="150">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projetos as $projeto)
                        <tr>
                            <td>{{ $projeto->id }}</td>
                            <td>{{ $projeto->titulo }}</td>
                            <td>
                                @forelse($projeto->areas as $area)
                                    <span class="badge bg-secondary me-1">
                                        {{ $area->nome }}
                                    </span>
                                @empty
                                    -
                                @endforelse
                            </td>

                            <td>{{ $projeto->localidade}}</td>
                            <td>{{ $projeto->coordenador }}</td>
                  <td class="text-nowrap">

                        {{-- Editar --}}
                        <a href="{{ route('admin.projetos.edit', $projeto) }}"
                        class="btn btn-warning btn-sm"
                        title="Editar">

                            <span class="d-none d-md-inline">Editar</span>
                            <span class="d-inline d-md-none">
                                <i class="fas fa-edit"></i>
                            </span>
                        </a>

                        {{-- Excluir --}}
                        <form action="{{ route('admin.projetos.destroy', $projeto) }}"
                            method="POST"
                            class="d-inline">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm"
                                    title="Excluir"
                                    onclick="return confirm('Excluir este projeto?')">

                                <span class="d-none d-md-inline">Excluir</span>
                                <span class="d-inline d-md-none">
                                    <i class="fas fa-trash"></i>
                                </span>
                            </button>
                        </form>

                    </td>

                        </tr>
                    @endforeach

                    @if($projetos->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center">
                                Nenhum projeto cadastrado.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
