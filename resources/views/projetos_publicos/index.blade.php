@extends('layouts.app')

@section('content')
<div class="container">

    <h2 class="mb-4">Projetos de Extensão</h2>

    {{-- FORMULÁRIO DE FILTROS --}}
    <form method="GET" class="mb-4">

        <div class="row">

            {{-- Palavra-chave --}}
            <div class="col-md-4 mb-2">
                <input type="text"
                       name="q"
                       class="form-control"
                       placeholder="Buscar por palavra-chave"
                       value="{{ request('q') }}">
            </div>

            {{-- Localidade --}}
            <div class="col-md-4 mb-2">
                <input type="text"
                       name="localidade"
                       class="form-control"
                       placeholder="Buscar por localidade"
                       value="{{ request('localidade') }}">
            </div>

            {{-- Botão filtrar --}}
            <div class="col-md-2 mb-2 d-grid">
                <button class="btn btn-primary">Filtrar</button>
            </div>

            {{-- Limpar filtros --}}
            <div class="col-md-2 mb-2 d-grid">
                <a href="{{ route('projetos.publicos.index') }}"
                   class="btn btn-secondary">
                    Limpar filtros
                </a>
            </div>

        </div>

        {{-- Áreas (recolhível) --}}
        <div class="mt-3">

            <button class="btn btn-outline-primary btn-sm"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#filtroAreas"
                    aria-expanded="false"
                    aria-controls="filtroAreas">
                Filtrar por área de conhecimento
            </button>

            <div class="collapse mt-2" id="filtroAreas">
                <div class="card card-body">

                    @foreach($areas as $area)
                        <div class="form-check">
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="area_id[]"
                                   value="{{ $area->id }}"
                                   id="area_{{ $area->id }}"
                                   {{ collect(request('area_id'))->contains($area->id) ? 'checked' : '' }}>

                            <label class="form-check-label" for="area_{{ $area->id }}">
                                {{ $area->nome }}
                            </label>
                        </div>
                    @endforeach

                </div>
            </div>

        </div>

    </form>

    {{-- LISTAGEM --}}
    @php use Illuminate\Support\Str; @endphp

    @forelse($projetos as $projeto)
        <div class="card mb-3">
            <div class="card-body">

                <h5 class="card-title">{{ $projeto->titulo }}</h5>

                <p class="card-text">
                    {{ Str::limit($projeto->descricao, 250) }}
                </p>

                <p class="mb-1">
                    <strong>Área:</strong> {{ $projeto->area->nome ?? 'Não informada' }}
                </p>

                <p class="mb-1">
                    <strong>Localidade:</strong> {{ $projeto->localidade }}
                </p>

                <p class="mb-1">
                    <strong>Organizador:</strong> {{ $projeto->coordenador }}
                </p>

                <p class="mb-0">
                    <strong>Período:</strong>
                    {{ \Carbon\Carbon::parse($projeto->data_inicio)->format('d/m/Y') }}
                    –
                    {{ \Carbon\Carbon::parse($projeto->data_fim)->format('d/m/Y') }}
                </p>

            </div>
        </div>
    @empty
        <div class="alert alert-warning">
            Nenhum projeto encontrado com os filtros informados.
        </div>
    @endforelse

    {{-- PAGINAÇÃO --}}
    <div class="mt-4">
        {{ $projetos->links() }}
    </div>

</div>
@endsection
