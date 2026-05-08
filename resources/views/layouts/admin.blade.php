<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administration - CERAPE</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        .sidebar { width: 280px; min-height: 100vh; background-color: #0f172a; color: white; transition: all 0.3s; }
        .sidebar-link { color: #cbd5e1; text-decoration: none; padding: 12px 20px; display: flex; align-items: center; border-radius: 8px; margin-bottom: 5px; transition: all 0.2s; }
        .sidebar-link:hover, .sidebar-link.active { background-color: #1e293b; color: white; }
        .sidebar-link i { width: 24px; text-align: center; margin-right: 10px; }
        .main-content { flex-grow: 1; min-height: 100vh; display: flex; flex-direction: column; }
        .topbar { background-color: white; box-shadow: 0 1px 3px rgba(0,0,0,0.05); height: 70px; display: flex; align-items: center; padding: 0 20px; }
        .content-wrapper { padding: 30px; flex-grow: 1; }
    </style>
</head>
<body class="d-flex">

    <!-- Sidebar -->
    <aside class="sidebar flex-shrink-0 d-none d-lg-block p-3">
        <div class="d-flex align-items-center justify-content-center mb-5 mt-3">
            <span class="fs-4 fw-bold text-white tracking-widest"><i class="fa-solid fa-graduation-cap me-2 text-primary"></i> CERAPE Admin</span>
        </div>
        
        <div class="mb-3 text-uppercase text-secondary small fw-bold px-3 tracking-widest">Général</div>
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-chart-line"></i> Vue d'ensemble
        </a>
        
        <div class="mb-3 mt-4 text-uppercase text-secondary small fw-bold px-3 tracking-widest">Contenus</div>
        <a href="{{ route('admin.articles.index') }}" class="sidebar-link {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}">
            <i class="fa-regular fa-newspaper"></i> Actualités
        </a>
        <a href="{{ route('admin.projets.index') }}" class="sidebar-link {{ request()->routeIs('admin.projets.*') ? 'active' : '' }}">
            <i class="fa-solid fa-clipboard-list"></i> Réalisations
        </a>
        <a href="{{ route('admin.events.index') }}" class="sidebar-link {{ request()->routeIs('admin.events.*') ? 'active' : '' }}">
            <i class="fa-regular fa-calendar-alt"></i> Événements
        </a>
        
        <div class="mb-3 mt-4 text-uppercase text-secondary small fw-bold px-3 tracking-widest">Gestion</div>
        <a href="{{ route('admin.dons.index') }}" class="sidebar-link {{ request()->routeIs('admin.dons.*') ? 'active' : '' }}">
            <i class="fa-solid fa-hand-holding-dollar"></i> Dons
        </a>
        <a href="{{ route('admin.contacts.index') }}" class="sidebar-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
            <i class="fa-regular fa-envelope"></i> Messages
        </a>

        <div class="mb-3 mt-4 text-uppercase text-secondary small fw-bold px-3 tracking-widest">Paramètres</div>
        <a href="{{ route('admin.settings.edit') }}" class="sidebar-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
            <i class="fa-solid fa-cog"></i> Configuration
        </a>
        
        <div class="mt-auto pt-5 pb-3 px-3">
            <div class="d-flex align-items-center">
                <div class="bg-primary rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 40px; height: 40px;">
                    <i class="fa-solid fa-user text-white"></i>
                </div>
                <div>
                    <div class="text-white fw-bold small">{{ Auth::user()->name ?? 'Admin' }}</div>
                    <div class="text-secondary small" style="font-size: 0.75rem;">{{ ucfirst(Auth::user()->role ?? 'Admin') }}</div>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Topbar -->
        <header class="topbar justify-content-between z-1">
            <div class="d-flex align-items-center">
                <button class="btn btn-light d-lg-none me-3" aria-label="Ouvrir le menu"><i class="fa-solid fa-bars"></i></button>
                <div class="input-group" style="width: 300px;">
                    <span class="input-group-text bg-light border-0"><i class="fa-solid fa-search text-muted"></i></span>
                    <input type="text" class="form-control bg-light border-0" placeholder="Rechercher...">
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('home') }}" target="_blank" class="btn btn-outline-secondary btn-sm rounded-pill px-3" title="Voir le site public">
                    <i class="fa-solid fa-globe me-2"></i> Voir le site
                </a>
                <div class="position-relative">
                    <button class="btn btn-light rounded-circle position-relative" aria-label="Notifications"><i class="fa-regular fa-bell"></i>
                        <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
                    </button>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-light rounded-circle text-danger" title="Déconnexion" aria-label="Se déconnecter"><i class="fa-solid fa-arrow-right-from-bracket"></i></button>
                </form>
            </div>
        </header>

        <!-- Dynamic Content -->
        <div class="content-wrapper">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h3 fw-bold text-dark mb-0">@yield('header', 'Tableau de bord')</h2>
                @yield('actions')
            </div>

            <x-flash-message />

            @yield('content')
        </div>
    </main>

</body>
</html>
