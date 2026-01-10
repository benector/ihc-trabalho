@extends('layouts.adminlte')

@section('content')

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Usuários</h3>
            <div class="card-tools">
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">
                    Novo Usuário
                </a>
            </div>
        </div>
        <div class="card-body table-responsive">

            <table class="table dt-responsive nowrap table-bordered">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Admin</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->is_admin ? 'Sim' : 'Não' }}</td>
                        <td class="text-nowrap">

                            {{-- Editar --}}
                            <a href="{{ route('admin.users.edit', $user) }}"
                            class="btn btn-sm btn-warning"
                            title="Editar">

                                <span class="d-none d-md-inline">Editar</span>
                                <span class="d-inline d-md-none">
                                    <i class="fas fa-edit"></i>
                                </span>
                            </a>

                            {{-- Excluir --}}
                            <form method="POST"
                                action="{{ route('admin.users.destroy', $user) }}"
                                class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-danger"
                                        title="Excluir"
                                        onclick="return confirm('Tem certeza?')">

                                    <span class="d-none d-md-inline">Excluir</span>
                                    <span class="d-inline d-md-none">
                                        <i class="fas fa-trash"></i>
                                    </span>
                                </button>
                            </form>

                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
