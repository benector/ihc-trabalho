@extends('layouts.adminlte')
@section('title', 'Admin - Áreas')


@section('content')
<div class="container-fluid">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Nova Área</h3>
        </div>

        <form action="{{ route('admin.areas.store') }}" method="POST">
            @csrf
            <div class="card-body table-responsive">
                <div class="form-group">
                    <label>Nome da Área</label>
                    <input type="text"
                           name="nome"
                           class="form-control"
                           required>
                </div>
            </div>

            <div class="card-footer">
                <button class="btn btn-primary">Salvar</button>
                <a href="{{ route('admin.areas.index') }}" class="btn btn-secondary">
                    Voltar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
