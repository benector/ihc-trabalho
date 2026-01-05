<div class="form-group">
    <label>Nome</label>
    <input type="text" name="name" class="form-control"
           value="{{ old('name', $user->name ?? '') }}" required>
</div>

<div class="form-group">
    <label>CPF</label>
    <input type="text" name="name" class="form-control"
           value="{{ old('name', $user->cpf ?? '') }}" required>
</div>

<div class="form-group">
    <label>Email</label>
    <input type="email" name="email" class="form-control"
           value="{{ old('email', $user->email ?? '') }}" required>
</div>

<div class="form-group">
    <label>Senha</label>
    <input type="password" name="password" class="form-control">
    @isset($user)
        <small>Deixe em branco para manter a senha atual</small>
    @endisset
</div>

<div class="form-check">
    <input type="checkbox" name="is_admin" class="form-check-input"
           {{ old('is_admin', $user->is_admin ?? false) ? 'checked' : '' }}>
    <label class="form-check-label">Administrador</label>
</div>
