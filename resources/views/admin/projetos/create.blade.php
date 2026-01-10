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
    <label class="mb-2 d-block">Áreas de Conhecimento</label>

    <div class="border rounded p-2"
         style="max-height: 35vh; overflow-y: auto;">

        @foreach($areas as $area)
            <div class="form-check">
                <input required class="form-check-input"
                       type="checkbox"
                       name="area_id[]"
                       value="{{ $area->id }}"
                       id="area_{{ $area->id }}"
                       @checked(
                           isset($projeto) &&
                           $projeto->areas->pluck('id')->contains($area->id)
                       )>

                <label class="form-check-label" for="area_{{ $area->id }}">
                    {{ $area->nome }}
                </label>
            </div>
        @endforeach

    </div>
    

    <small class="text-muted">
        Selecione ao menos uma área.
    </small>
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
