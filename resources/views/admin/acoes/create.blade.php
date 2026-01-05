@extends('layouts.adminlte')

@section('title', 'Nova Ação')

@section('content')

<h1>Cadastrar Nova Ação</h1>

<form method="POST" action="{{ route('admin.acoes.store') }}">
@csrf

@include('admin.acoes.form')

<button class="btn btn-success mt-3">Salvar</button>
<a href="{{ route('admin.acoes.index') }}" class="btn btn-secondary mt-3">Cancelar</a>

</form>

@endsection
