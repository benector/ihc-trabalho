@extends('layouts.adminlte')

@section('content')
<div class="container-fluid">
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Editar Projeto</h3>
        </div>

        <form action="{{ route('admin.projetos.update', $projeto) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card-body table-responsive">
                <div class="form-group">
                    <label>Título</label>
                    <input type="text"
                           name="titulo"
                           class="form-control"
                           value="{{ $projeto->titulo }}"
                           required>
                </div>

                <div class="form-group">
                    <label>Descrição</label>
                    <textarea name="descricao"
                              class="form-control"
                              rows="4"
                              required>{{ $projeto->descricao }}</textarea>
                </div>
<div class="form-group">
    <label class="mb-2 d-block">Áreas de Conhecimento</label>

    <div class="border rounded p-2"
         style="max-height: 200px; overflow-y: auto;">

        <div class="row">
            @foreach($areas as $area)
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input"
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
                </div>
            @endforeach
        </div>

    </div>

    <small class="text-muted">
        Selecione ao menos uma área.
    </small>
</div>


                   <div class="form-group">
                    <label>Local</label>
                    <textarea name="localidade"
                              class="form-control"
                              rows="4"
                              required>{{ $projeto->localidade }}</textarea>
                </div>


                <div class="form-group">
                    <label>Coordenador</label>
                    <input type="text"
                           name="coordenador"
                           class="form-control"
                           value="{{ $projeto->coordenador }}"
                           required>
                </div>

                <div class="form-group">
                    <label>Data de Início</label>
                    <input type="date"
                           name="data_inicio"
                           class="form-control"
                           value="{{ $projeto->data_inicio->format('Y-m-d') }}"
                           required>
                </div>

                <div class="form-group">
                    <label>Data de Fim</label>
                    <input type="date"
                           name="data_fim"
                           class="form-control"
                           value="{{ optional($projeto->data_fim)->format('Y-m-d') }}">
                </div>
            </div>

            <div class="card-footer">
                <button class="btn btn-warning">Atualizar</button>
                <a href="{{ route('admin.projetos.index') }}" class="btn btn-secondary">
                    Voltar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
