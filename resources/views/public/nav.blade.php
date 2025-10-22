<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Impulso MEI - Portal de Produtos')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        /* Cabeçalho moderno */
        .app-header {
            background: linear-gradient(135deg, #fff0f6 0%, #ffe3ec 100%);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.06);
            position: sticky;
            top: 0;
            z-index: 1002;
            padding: 10px 12px;
        }

        /* Botão hamburguer */
        .hamburger {
            position: fixed;
            top: 15px;
            left: 15px;
            font-size: 24px;
            cursor: pointer;
            z-index: 1003;
            background: #ffffffcc;
            border: 1px solid rgba(0, 0, 0, 0.08);
            border-radius: 9999px;
            padding: 6px 10px;
            line-height: 1;
            transition: all .2s ease;
            color: #db2777;
        }

        .hamburger:hover {
            box-shadow: 0 4px 12px rgba(219, 39, 119, 0.15);
            transform: translateY(-1px);
        }

        /* Menu lateral com efeito glass */
        .sidebar {
            position: fixed;
            top: 0;
            left: -280px;
            width: 280px;
            height: 100%;
            color: #1f2937;
            transition: left 0.3s ease, opacity .2s ease;
            padding: 20px;
            z-index: 1002;
            padding-top: 72px;
            pointer-events: none;
            opacity: 0;
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: saturate(160%) blur(10px);
            border-right: 1px solid rgba(0, 0, 0, 0.06);
        }

        .sidebar.active {
            left: 0;
            pointer-events: auto;
            opacity: 1;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li { margin: 8px 0; }

        .sidebar ul li a {
            display: block;
            text-decoration: none;
            font-size: 16px;
            padding: 10px 12px;
            border-radius: 10px;
            color: #374151;
            transition: background-color .2s ease, color .2s ease;
        }

        .sidebar ul li a:hover {
            background: #fdf2f8;
            color: #db2777;
        }

        .sidebar ul li a.active {
            background: #fdf2f8;
            color: #db2777;
            font-weight: 600;
        }

        /* Barra de busca */
        .search-bar {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 25px;
            padding: 8px 20px;
            border: 1px solid rgba(219, 39, 119, 0.2);
            transition: all 0.3s ease;
        }

        .search-bar:focus {
            outline: none;
            border-color: #db2777;
            box-shadow: 0 0 0 3px rgba(219, 39, 119, 0.1);
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .sidebar { width: 75%; max-width: 320px; }
            .hamburger { font-size: 26px; }
        }
    </style>
</head>

<body>
    <header class="app-header d-flex justify-content-between align-items-center">
        <div class="">
            {{-- Botão hamburguer --}}
            <button class="hamburger" id="hamburger" onclick="toggleMenu()" type="button" aria-label="Abrir menu">☰</button>

            {{-- Menu lateral --}}
            <aside class="sidebar" id="sidebar">
                <ul>
                    <li><a href="{{ route('public.index') }}" class="{{ request()->routeIs('public.index') ? 'active' : '' }}">
                        <i class="fas fa-home me-2"></i>Início
                    </a></li>
                    <li><a href="{{ route('public.produtos') }}" class="{{ request()->routeIs('public.produtos') ? 'active' : '' }}">
                        <i class="fas fa-box me-2"></i>Produtos
                    </a></li>
                    <li><a href="{{ route('public.negocios') }}" class="{{ request()->routeIs('public.negocios') ? 'active' : '' }}">
                        <i class="fas fa-store me-2"></i>Negócios
                    </a></li>
                    <li><a href="{{ route('form_cadastro_negocio') }}">
                        <i class="fas fa-user-plus me-2"></i>Cadastrar Negócio
                    </a></li>
                    <li><a href="{{ route('form_login_negocio') }}">
                        <i class="fas fa-sign-in-alt me-2"></i>Área do Empreendedor
                    </a></li>
                </ul>
            </aside>
        </div>

        <div class="flex-fill mx-3">
            {{-- Barra de busca --}}
            <form action="{{ route('public.busca') }}" method="GET" class="d-flex">
                <input type="text" name="q" class="form-control search-bar" 
                       placeholder="Buscar produtos ou negócios..." 
                       value="{{ request('q') }}">
                <button type="submit" class="btn btn-primary rounded-pill ms-2">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>

        <div class="">
            <img src="{{ asset('/logotipos/impulsoMei.png') }}" alt="Impulso MEI" 
                 class="rounded-circle" style="width:56px;height:56px;object-fit:cover;border:2px solid #fbcfe8;">
        </div>
    </header>

    {{-- Conteúdo --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <script>
        function toggleMenu() {
            const sidebar = document.getElementById("sidebar");
            const hamburger = document.getElementById("hamburger");

            sidebar.classList.toggle("active");

            // muda o ícone
            if (sidebar.classList.contains("active")) {
                hamburger.textContent = "✖"; // X
            } else {
                hamburger.textContent = "☰"; // hamburguer
            }
        }
    </script>
</body>

</html>
