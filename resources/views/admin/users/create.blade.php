@extends('layouts.adminlte')
@section('title', 'Admin - Usuários')

@section('content')

<div class="container-fluid">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Novo Usuário</h3>
        </div>

        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="card-body table-responsive">
                <div class="form-group">
                    <label>Nome</label>
                    <input type="text" name="name" class="form-control"
                        value="{{ old('name', $user->name ?? '') }}" required>
                </div>

                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input type="tel"  name="cpf" class="form-control mask-cpf"
                        placeholder="000.000.000-00"
                        value="{{ old('cpf', $user->cpf ?? '') }}" required>
                </div>


                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control"
                        value="{{ old('email', $user->email ?? '') }}" required>
                </div>

                <div class="form-group">
                    <input type="password" name="password" class="form-control" 
           id="password"
           {{-- Pattern para: 1 minusc, 1 maiusc, 1 num, 1 especial, min 8 --}}
           pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,}"
                        title="A senha deve ter no mínimo 8 caracteres, incluindo letras maiúsculas, minúsculas, números e caracteres especiais."
                        required>
                    <small class="text-muted">
                        Mínimo de 8 caracteres (A-z, 0-9 e @#$...).
                    </small>
                    @isset($user)
                        <small>Deixe em branco para manter a senha atual</small>
                    @endisset
                </div>

                <div class="form-check">
                    <input type="checkbox" name="is_admin" class="form-check-input"
                        {{ old('is_admin', $user->is_admin ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label">Administrador</label>
                </div>
            </div>
             <div class="card-footer">
                <button class="btn btn-primary">Salvar</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                    Voltar
                </a>
            </div>
        </form>
    </div>
</div>
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cpfInput = document.querySelector('.mask-cpf');

        if (cpfInput) {
            cpfInput.addEventListener('input', function(e) {
                // 1. Pega apenas os números
                let value = e.target.value.replace(/\D/g, ''); 
                
                // 2. Limita a 11 dígitos (tamanho do CPF)
                if (value.length > 11) value = value.slice(0, 11);

                // 3. Aplica a máscara progressivamente
                if (value.length > 9) {
                    value = value.replace(/^(\d{3})(\d{3})(\d{3})(\d{2}).*/, "$1.$2.$3-$4");
                } else if (value.length > 6) {
                    value = value.replace(/^(\d{3})(\d{3})(\d{1,3}).*/, "$1.$2.$3");
                } else if (value.length > 3) {
                    value = value.replace(/^(\d{3})(\d{1,3}).*/, "$1.$2");
                }

                // 4. Devolve o valor formatado para o campo
                e.target.value = value;
            });

            // Evita que o usuário digite letras se o teclado não for numérico
            cpfInput.addEventListener('keypress', function(e) {
                if (!/[0-9]/.test(e.key)) {
                    e.preventDefault();
                }
            });
        }
    });
</script>
@endpush

@endsection
