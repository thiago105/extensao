<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Área de Usuário') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        :root {

            --cor-primaria: #005F73;
            --cor-secundaria: #E29578;
            --cor-terciaria: #94D2BD;
            --cor-branco: #F5F5F5;
            --cor-preto: #0B0C10;
            --cor-erro-falha: #D62828;
            --cor-sucesso: #2D6A4F;
            --cor-header: #404040;
            --cor-sidebar: #555555;
            --cor-body: #F8F8F8;

            --sidebar-expanded: 240px;
            --sidebar-collapsed: 70px;
            --cor-body-bg: var(--cor-body);
        }

        header {
            height: 10vh;
            position: relative;
            z-index: 1002;
        }

        body {
            background: var(--cor-body-bg);
            overflow-x: hidden;
        }


        .bg-active {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 6px;
        }



        #sidebar {
            background-color: var(--cor-sidebar);
            width: var(--sidebar-expanded);
            min-height: 90vh;
            transition: all 0.3s ease;
            overflow: hidden;

        }

        #sidebar.collapsed {
            width: var(--sidebar-collapsed);
        }

        #sidebar .nav-link {
            color: var(--cor-branco);
            padding: 0.9rem 1.25rem;
            display: flex;
            align-items: center;
            white-space: nowrap;
        }

        #sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        #sidebar .nav-link .bi {
            font-size: 1.25rem;
            margin-right: 0.75rem;
            min-width: 20px;
            text-align: center;
        }

        #sidebar .nav-link .sidebar-text {
            opacity: 1;
            transition: opacity 0.2s ease;
        }


        #sidebar.collapsed .nav-link {

            justify-content: center;
        }

        #sidebar.collapsed .nav-link .bi {

            margin-right: 0;
        }

        #sidebar.collapsed .nav-link .sidebar-text {
            opacity: 0;
            width: 0;
            display: none;
        }


        #content-wrapper {
            width: calc(100% - var(--sidebar-expanded));
            transition: all 0.3s ease;
        }

        #content-wrapper.expanded {
            width: calc(100% - var(--sidebar-collapsed));
        }

        @media (max-width: 768px) {
            #sidebar {
                position: fixed;
                left: 0;
                top: 10vh;
                z-index: 1001;
                height: 90vh;
                transform: translateX(0);
                transition: transform 0.3s ease;
            }

            #sidebar.collapsed {
                transform: translateX(calc(-1 * var(--sidebar-expanded)));
            }

            #content-wrapper,
            #content-wrapper.expanded {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <header class="bg-dark text-white d-flex justify-content-between align-items-center px-3">
        <div class="d-flex align-items-center flex-grow-1">
            <button class="btn btn-dark" type="button" id="toggleSidebar" style="font-size: 1.5rem; line-height: 1;">
                <i class="bi bi-list"></i>
            </button>
            <img src="{{ asset('imgs/logo_menor.png') }}" class="ms-3" style="height: 45px;">
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-danger ms-auto">Deslogar</button>
        </form>
    </header>

    <div class="d-flex " style="min-height: 90vh;">
        <nav id="sidebar">
            <ul class="nav flex-column p-2 pt-3">
                <li class="nav-item">
                    <a href="{{ route('areaDaInstituicao.index') }}" class="nav-link">
                        <i class="bi bi-grid-fill"></i>
                        <span class="sidebar-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('areaDaInstituicao.material') }}" class="nav-link">
                        <i class="bi bi-book"></i>
                        <span class="sidebar-text">Material</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('areaDaInstituicao.estoque') }}" class="nav-link">
                        <i class="bi bi-balloon-heart"></i>
                        <span class="sidebar-text">Estoque</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('areaDaInstituicao.pontoDeColeta.index') }}" class="nav-link">
                        <i class="bi bi-geo"></i>
                        <span class="sidebar-text">Gerenciar Pontos de Coleta</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('areaDaInstituicao.pedidosDeDoacao') }}" class="nav-link">
                        <i class="bi bi-list-check"></i>
                        <span class="sidebar-text">Pedidos de Doação</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('areaDaInstituicao.perfilInstituicao') }}" class="nav-link">
                        <i class="bi bi-person-fill"></i>
                        <span class="sidebar-text">Perfil</span>
                    </a>
                </li>
            </ul>
        </nav>
        <main id="content-wrapper" class="p-4">

            @yield('content')

        </main>

    </div>

    <script>
        function setInitialSidebarState() {
            const sidebar = document.getElementById('sidebar');
            const contentWrapper = document.getElementById('content-wrapper');


            if (window.innerWidth <= 768) {
                sidebar.classList.add('collapsed');
                contentWrapper.classList.add('expanded');
            }
        }

        document.addEventListener('DOMContentLoaded', setInitialSidebarState);

        document.getElementById('toggleSidebar').addEventListener('click', () => {
            document.getElementById('sidebar').classList.toggle('collapsed');
            document.getElementById('content-wrapper').classList.toggle('   ');
        });
    </script>

</body>

</html>