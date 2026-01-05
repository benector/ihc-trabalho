@extends('layouts.adminlte')
@section('title', 'Admin - Áreass')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Áreas de Extensão</h3>
            <div class="card-tools">
                <a href="{{ route('admin.areas.create') }}" class="btn btn-primary btn-sm">
                    Nova Área
                </a>
            </div>
        </div>

        <div class="card-body table-responsive">
            <table class="table dt-responsive nowrap table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th width="150">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($areas as $area)
                        <tr>
                            <td>{{ $area->id }}</td>
                            <td>{{ $area->nome }}</td>
                            <td>
                                <a href="{{ route('admin.areas.edit', $area) }}" class="btn btn-warning btn-sm">
                                    Editar
                                </a>

                                <form action="{{ route('admin.areas.destroy', $area) }}"
                                      method="POST"
                                      style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Excluir esta área?')">
                                        Excluir
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if($areas->isEmpty())
                        <tr>
                            <td colspan="3" class="text-center">Nenhuma área cadastrada.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
