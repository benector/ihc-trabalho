@extends('layouts.adminlte')

@section('content')
<div class="container-fluid">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Novo Projeto de Extensão</h3>
        </div>

        <form action="{{ route('admin.projetos.store') }}" method="POST">
            @csrf

            <div class="card-body table-responsive">
                <div class="form-group">
                    <label>Título</label>
                    <input type="text" name="titulo" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Descrição</label>
                    <textarea name="descricao" class="form-control" rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <label>Área</label>
                    <select name="area_id" class="form-control" required>
                        <option value="">Selecione</option>
                        @foreach($areas as $area)
                            <option value="{{ $area->id }}">{{ $area->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Local</label>
                    <input type="text" name="localidade" class="form-control" required>
                </div>


                <div class="form-group">
                    <label>Coordenador</label>
                    <input type="text" name="coordenador" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Data de Início</label>
                    <input type="date" name="data_inicio" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Data de Fim</label>
                    <input type="date" name="data_fim" class="form-control">
                </div>
            </div>

            <div class="card-footer">
                <button class="btn btn-primary">Salvar</button>
                <a href="{{ route('admin.projetos.index') }}" class="btn btn-secondary">
                    Voltar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
