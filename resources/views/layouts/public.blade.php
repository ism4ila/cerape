<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $siteSettings['site_name'] }} · @yield('title', $siteSettings['site_tagline'])</title>
    <meta name="description" content="{{ $siteSettings['site_description'] }}">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $siteSettings['site_name'] }} · @yield('title', $siteSettings['site_tagline'])">
    <meta property="og:description" content="{{ $siteSettings['site_description'] }}">
    <meta property="og:image" content="{{ !empty($siteSettings['logo']) ? (str_starts_with($siteSettings['logo'], 'http') ? $siteSettings['logo'] : asset('storage/' . $siteSettings['logo'])) : asset('favicon.ico') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ $siteSettings['site_name'] }} · @yield('title', $siteSettings['site_tagline'])">
    <meta property="twitter:description" content="{{ $siteSettings['site_description'] }}">
    <meta property="twitter:image" content="{{ !empty($siteSettings['logo']) ? (str_starts_with($siteSettings['logo'], 'http') ? $siteSettings['logo'] : asset('storage/' . $siteSettings['logo'])) : asset('favicon.ico') }}">

    @if(!empty($siteSettings['favicon']))
        <link rel="icon" type="image/x-icon" href="{{ \Illuminate\Support\Str::startsWith($siteSettings['favicon'], ['http://', 'https://']) ? $siteSettings['favicon'] : \Illuminate\Support\Facades\Storage::url($siteSettings['favicon']) }}">
    @endif
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            @if(!empty($siteSettings['theme_primary_color']))
                --cerape-orange: {{ $siteSettings['theme_primary_color'] }};
                /* Génération automatique d'une version plus claire pour les fonds */
                --cerape-orange-light: {{ $siteSettings['theme_primary_color'] }}15; 
                --cerape-orange-mid: {{ $siteSettings['theme_primary_color'] }}CC;
            @endif
        }
    </style>
</head>
<body class="flex min-h-screen flex-col bg-white">
    <a href="#main-content" class="skip-link">{{ __('Aller au contenu') }}</a>

    <x-nav />

    <main id="main-content" class="flex-1">
        <div class="mx-auto mt-4 max-w-7xl px-6 lg:px-16">
            <x-flash-message />
        </div>
        @yield('content')
    </main>

    <footer class="mt-auto bg-[--cerape-dark] px-6 py-12 lg:px-16">
        <div class="mx-auto max-w-7xl">
            <div class="mb-10 grid gap-8 lg:grid-cols-4">
                <div>
                    <div class="flex items-center gap-2">
                        <span class="h-2.5 w-2.5 rounded-full bg-[--cerape-orange]"></span>
                        <span class="text-sm font-medium text-white">{{ __('CERAPE') }}</span>
                    </div>
                    <p class="mb-4 mt-2 text-xs leading-relaxed text-[--cerape-dark-muted]">
                        {{ __('Association engagée pour l\'éducation, la santé et le développement local au Cameroun.') }}
                    </p>
                    <div class="flex gap-2">
                        <a href="{{ $siteSettings['facebook_url'] ?? '#' }}" target="_blank" rel="noopener" class="flex h-8 w-8 items-center justify-center rounded-full border border-gray-700 text-[--cerape-dark-muted] hover:text-[--cerape-orange-mid]"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
                        <a href="{{ $siteSettings['instagram_url'] ?? '#' }}" target="_blank" rel="noopener" class="flex h-8 w-8 items-center justify-center rounded-full border border-gray-700 text-[--cerape-dark-muted] hover:text-[--cerape-orange-mid]"><i class="fab fa-instagram" aria-hidden="true"></i></a>
                        <a href="mailto:{{ $siteSettings['contact_email'] }}" class="flex h-8 w-8 items-center justify-center rounded-full border border-gray-700 text-[--cerape-dark-muted] hover:text-[--cerape-orange-mid]"><i class="fa-solid fa-envelope" aria-hidden="true"></i></a>
                    </div>
                </div>
                <div>
                    <p class="mb-3 text-xs font-medium uppercase tracking-wider text-white">{{ __('Navigation') }}</p>
                    <a href="{{ route('home') }}" class="mb-2 block text-xs text-[--cerape-dark-muted] hover:text-[--cerape-orange-mid]">{{ __('Accueil') }}</a>
                    <a href="{{ route('about') }}" class="mb-2 block text-xs text-[--cerape-dark-muted] hover:text-[--cerape-orange-mid]">{{ __('Qui sommes-nous') }}</a>
                    <a href="{{ route('domaines.index') }}" class="mb-2 block text-xs text-[--cerape-dark-muted] hover:text-[--cerape-orange-mid]">{{ __('Domaines') }}</a>
                    <a href="{{ route('projets.index') }}" class="mb-2 block text-xs text-[--cerape-dark-muted] hover:text-[--cerape-orange-mid]">{{ __('Projets') }}</a>
                </div>
                <div>
                    <p class="mb-3 text-xs font-medium uppercase tracking-wider text-white">{{ __('Ressources') }}</p>
                    <a href="{{ route('faq') }}" class="mb-2 block text-xs text-[--cerape-dark-muted] hover:text-[--cerape-orange-mid]">{{ __('FAQ') }}</a>
                    <a href="{{ route('contact') }}" class="mb-2 block text-xs text-[--cerape-dark-muted] hover:text-[--cerape-orange-mid]">{{ __('Contact') }}</a>
                    <a href="{{ route('don') }}" class="mb-2 block text-xs text-[--cerape-dark-muted] hover:text-[--cerape-orange-mid]">{{ __('Faire un don') }}</a>
                    <a href="{{ route('legal.privacy') }}" class="mb-2 block text-xs text-[--cerape-dark-muted] hover:text-[--cerape-orange-mid]">{{ __('Confidentialité') }}</a>
                </div>
                <div>
                    <p class="mb-3 text-xs font-medium uppercase tracking-wider text-white">{{ __('À propos') }}</p>
                    <a href="{{ route('about') }}" class="mb-2 block text-xs text-[--cerape-dark-muted] hover:text-[--cerape-orange-mid]">{{ __('Notre mission') }}</a>
                    <a href="{{ route('events.index') }}" class="mb-2 block text-xs text-[--cerape-dark-muted] hover:text-[--cerape-orange-mid]">{{ __('Événements') }}</a>
                    <a href="{{ route('articles.index') }}" class="mb-2 block text-xs text-[--cerape-dark-muted] hover:text-[--cerape-orange-mid]">{{ __('Actualités') }}</a>
                </div>
            </div>
            <div class="flex flex-col items-start justify-between gap-4 border-t border-gray-700 pt-5 sm:flex-row sm:items-center">
                <p class="text-xs text-gray-600">&copy; {{ date('Y') }} {{ $siteSettings['site_name'] }}. {{ __('Tous droits réservés.') }}</p>
                <div class="flex items-center gap-2">
                    <span class="rounded-md border border-[--cerape-orange] px-2 py-1 text-xs text-[--cerape-orange-mid]">{{ __('FR') }}</span>
                    <span class="rounded-md border border-gray-700 px-2 py-1 text-xs text-[--cerape-dark-muted]">{{ __('EN') }}</span>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
