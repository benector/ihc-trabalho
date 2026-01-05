<div class="form-group">
    <label>Título</label>
    <input type="text" name="titulo" class="form-control"
           value="{{ old('titulo', $acao->titulo ?? '') }}" required>
</div>

<div class="form-group">
    <label>Área</label>
    <select name="area_id" class="form-control" required>
        @foreach($areas as $area)
            <option value="{{ $area->id }}"
                {{ (old('area_id', $acao->area_id ?? '') == $area->id) ? 'selected' : '' }}>
                {{ $area->nome }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label>Responsável</label>
    <input type="text" name="responsavel" class="form-control"
           value="{{ old('responsavel', $acao->responsavel ?? '') }}" required>
</div>

<div class="form-group">
    <label>Local</label>
    <input type="text" name="local" class="form-control"
           value="{{ old('local', $acao->local ?? '') }}" required>
</div>

<div class="form-group">
    <label>Data Início</label>
    <input type="date" name="data_inicio" class="form-control"
           value="{{ old('data_inicio', $acao->data_inicio ?? '') }}" required>
</div>

<div class="form-group">
    <label>Data Fim</label>
    <input type="date" name="data_fim" class="form-control"
           value="{{ old('data_fim', $acao->data_fim ?? '') }}" required>
</div>

<div class="form-group">
    <label>Descrição</label>
    <textarea name="descricao" class="form-control" rows="4" required>
        {{ old('descricao', $acao->descricao ?? '') }}
    </textarea>
</div>
