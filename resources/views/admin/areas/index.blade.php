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
                       <td class="text-nowrap">

                            {{-- Editar --}}
                            <a href="{{ route('admin.areas.edit', $area) }}"
                            class="btn btn-warning btn-sm"
                            title="Editar">

                                <span class="d-none d-md-inline">Editar</span>
                                <span class="d-inline d-md-none">
                                    <i class="fas fa-edit"></i>
                                </span>
                            </a>

                            {{-- Excluir --}}
                            <form action="{{ route('admin.areas.destroy', $area) }}"
                                method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                        title="Excluir"
                                        onclick="return confirm('Excluir esta área?')">

                                    <span class="d-none d-md-inline">Excluir</span>
                                    <span class="d-inline d-md-none">
                                        <i class="fas fa-trash"></i>
                                    </span>
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
