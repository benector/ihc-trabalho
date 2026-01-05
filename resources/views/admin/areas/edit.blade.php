@extends('layouts.adminlte')

@section('content')
<div class="container-fluid">
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Editar Área</h3>
        </div>

        <form action="{{ route('admin.areas.update', $area) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card-body table-responsive">
                <div class="form-group">
                    <label>Nome da Área</label>
                    <input type="text"
                           name="nome"
                           class="form-control"
                           value="{{ $area->nome }}"
                           required>
                </div>
            </div>

            <div class="card-footer">
                <button class="btn btn-warning">Atualizar</button>
                <a href="{{ route('admin.areas.index') }}" class="btn btn-secondary">
                    Voltar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
