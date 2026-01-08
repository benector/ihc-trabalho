@extends('layouts.app')

@section('content')
<div class="container">

    <h2 class="mb-3">Projetos de Extensão</h2>

    {{-- ===================== --}}
    {{-- FORMULÁRIO DE FILTROS --}}
    {{-- ===================== --}}
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

        {{-- ================= --}}
        {{-- Áreas (recolhível) --}}
        {{-- ================= --}}
        <div class="mt-3">

            <button class="btn btn-outline-primary btn-sm"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#filtroAreas">
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

{{-- ========================= --}}
{{-- RESUMO + FILTROS APLICADOS --}}
{{-- ========================= --}}
<div class="mb-3">

    {{-- Quantidade --}}
    <strong>
        {{ $projetos->total() }}
        {{ $projetos->total() === 1 ? 'resultado encontrado' : 'resultados encontrados' }}
    </strong>

    {{-- Texto explicativo dos filtros --}}
    @php
        $filtros = [];

        if(request('q')) {
            $filtros[] = 'palavra-chave "' . request('q') . '"';
        }

        if(request('localidade')) {
            $filtros[] = 'localidade "' . request('localidade') . '"';
        }

        if(request('area_id')) {
            $nomesAreas = $areas
                ->whereIn('id', request('area_id'))
                ->pluck('nome')
                ->implode(', ');

            $filtros[] = 'área(s) ' . $nomesAreas;
        }
    @endphp

    @if(count($filtros))
        <div class="text-muted mt-1">
            Exibindo resultados para {{ implode(', ', $filtros) }}.
        </div>
    @endif

</div>


    {{-- ================= --}}
    {{-- LISTAGEM --}}
    {{-- ================= --}}
    @php use Illuminate\Support\Str; @endphp

    @forelse($projetos as $projeto)
        <div class="card mb-3">
            <div class="card-body">

                <h5 class="card-title">{{ $projeto->titulo }}</h5>

                <p class="card-text">
                    {{ Str::limit($projeto->descricao, 250) }}
                </p>

                {{-- Área como label --}}
                <p class="mb-1">
                    <span class="badge bg-primary">
                        {{ $projeto->area->nome ?? 'Área não informada' }}
                    </span>
                </p>

                <p class="mb-1">
                    <strong>Localidade:</strong> {{ $projeto->localidade }}
                </p>

                <p class="mb-1">
                    <strong>Organizador:</strong> {{ $projeto->coordenador }}
                </p>

                <p class="mb-2">
                    <strong>Período:</strong>
                    {{ \Carbon\Carbon::parse($projeto->data_inicio)->format('d/m/Y') }}
                    –
                    {{ \Carbon\Carbon::parse($projeto->data_fim)->format('d/m/Y') }}
                </p>

                <a href="https://www2.ufjf.br/proex/extensao-universitaria/editais/"
                   target="_blank"
                   class="btn btn-primary btn-sm">
                    Quero me inscrever
                </a>

            </div>
        </div>
    @empty
        {{-- Mensagem de nenhum resultado --}}
        <div class="alert alert-warning">
            Nenhum projeto foi encontrado com os filtros selecionados.
        </div>
    @endforelse

    {{-- ================= --}}
    {{-- PAGINAÇÃO --}}
    {{-- ================= --}}
    <div class="mt-4">
        {{ $projetos->withQueryString()->links() }}
    </div>

</div>
@endsection
