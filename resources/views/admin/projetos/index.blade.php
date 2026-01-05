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
                            <td>{{ $projeto->area->nome ?? '-' }}</td>
                            <td>{{ $projeto->localidade}}</td>
                            <td>{{ $projeto->coordenador }}</td>
                            <td>
                                <a href="{{ route('admin.projetos.edit', $projeto) }}"
                                   class="btn btn-warning btn-sm">
                                    Editar
                                </a>

                                <form action="{{ route('admin.projetos.destroy', $projeto) }}"
                                      method="POST"
                                      style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Excluir este projeto?')">
                                        Excluir
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
