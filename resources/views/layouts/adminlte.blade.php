<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Extensão UFJF')</title>

    {{-- Font Awesome para os ícones funcionarem --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    {{-- AdminLTE e Scripts via Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    {{-- Navbar Superior --}}
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
    </nav>

    {{-- Sidebar (Menu Lateral) --}}
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <div class="brand-link d-flex justify-content-between align-items-center">
            <a href="/" class="brand-text font-weight-light" style="color: white; padding-left: 15px;">Extensão UFJF</a>
            <a href="#" class="d-md-none text-white p-2" data-widget="pushmenu">
                <i class="fas fa-times"></i>
            </a>
        </div>

        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
<li class="nav-item">
                        <a href="{{ route('admin.areas.index') }}" 
                           class="nav-link {{ request()->routeIs('admin.areas.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-th"></i>
                            <p>Áreas</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.projetos.index') }}" 
                           class="nav-link {{ request()->routeIs('admin.projetos.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-project-diagram"></i>
                            <p>Projetos</p>
                        </a>
                    </li>                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Usuários</p>
                        </a>
                    </li>
                       </li>                    <li class="nav-item">
                        <a href="{{ route('projetos.publicos.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Página pública</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Sair</p>
                        </a>
                    </li>

                    {{-- Formulário oculto necessário para o Logout --}}
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </ul>
            </nav>
        </div>
    </aside>

    {{-- Conteúdo das Views --}}
    <div class="content-wrapper p-3">
    <div class="container-fluid">
        
        {{-- 1. Erros de Validação (Campos obrigatórios, senhas fracas, etc) --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h5><i class="icon fas fa-ban"></i> Erro no preenchimento!</h5>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        {{-- 2. Erros de Operação (Erro de banco de dados, exclusão proibida) --}}
        @if(session('error'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="icon fas fa-exclamation-triangle"></i> {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        {{-- 3. Sucesso (Criado, Editado ou Excluído com sucesso) --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="icon fas fa-check"></i> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @yield('content')
    </div>
</div>

</div>
@stack('scripts') 
</body>
</html>