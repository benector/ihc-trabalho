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
                    <label>Área</label>
                    <select name="area_id" class="form-control" required>
                        @foreach($areas as $area)
                            <option value="{{ $area->id }}"
                                @selected($area->id == $projeto->area_id)>
                                {{ $area->nome }}
                            </option>
                        @endforeach
                    </select>
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
