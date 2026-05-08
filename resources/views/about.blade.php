@extends('layouts.public')

@section('title', __('À propos de nous'))

@section('content')
<section class="bg-[--cerape-orange-light] px-6 py-16 lg:px-16">
    <div class="mx-auto grid max-w-7xl gap-10 lg:grid-cols-2 lg:items-center">
        <div>
            <span class="inline-flex items-center gap-2 rounded-full border border-gray-200 bg-white px-3 py-1 text-xs text-gray-500">
                <span class="h-2 w-2 rounded-full bg-[--cerape-orange]"></span>
                {{ __('Notre histoire') }}
            </span>
            <h1 class="mb-4 mt-5 text-3xl font-medium leading-snug text-gray-900 lg:text-4xl">{{ $siteSettings['site_name'] }}</h1>
            <p class="mb-4 text-sm leading-relaxed text-gray-600">{{ $siteSettings['site_description'] }}</p>
            <p class="text-sm leading-relaxed text-gray-600">
                {{ __('Fondée le 30 septembre 2022 et basée à Mandjou, dans la région de l\'Est du Cameroun, notre association rassemble les énergies citoyennes pour créer un impact durable autour de l\'éducation, de la santé communautaire et de l\'inclusion sociale.') }}
            </p>
        </div>
        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white">
            <img src="https://images.unsplash.com/photo-1524178232363-1fb28f74b671?auto=format&fit=crop&q=80&w=1200" alt="{{ __('Histoire de CERAPE') }}" class="aspect-video w-full object-cover" width="1200" height="675" loading="lazy">
        </div>
    </div>
</section>

<section class="bg-white px-6 py-14 lg:px-16">
    <div class="mx-auto max-w-7xl">
        <h2 class="mb-8 text-2xl font-medium text-gray-900">{{ __('Mission, vision, valeurs') }}</h2>
        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
            <article class="rounded-xl border border-gray-200 bg-gray-50 p-5">
                <span class="mb-3 flex h-10 w-10 items-center justify-center rounded-xl bg-[--cerape-orange-light] text-[--cerape-orange]">
                    <i class="fa-solid fa-bullseye" aria-hidden="true"></i>
                </span>
                <h3 class="mb-2 text-base font-medium text-gray-900">{{ __('Mission') }}</h3>
                <p class="text-sm leading-relaxed text-gray-600">{{ __('Favoriser l\'accès à une éducation de qualité et soutenir les initiatives communautaires pour un développement durable.') }}</p>
            </article>
            <article class="rounded-xl border border-gray-200 bg-gray-50 p-5">
                <span class="mb-3 flex h-10 w-10 items-center justify-center rounded-xl bg-[--cerape-green-light] text-[--cerape-green]">
                    <i class="fa-solid fa-eye" aria-hidden="true"></i>
                </span>
                <h3 class="mb-2 text-base font-medium text-gray-900">{{ __('Vision') }}</h3>
                <p class="text-sm leading-relaxed text-gray-600">{{ __('Devenir un acteur clé de la transformation sociale par l\'éducation au Cameroun et au-delà.') }}</p>
            </article>
            <article class="rounded-xl border border-gray-200 bg-gray-50 p-5">
                <span class="mb-3 flex h-10 w-10 items-center justify-center rounded-xl bg-[--cerape-amber-light] text-[--cerape-amber]">
                    <i class="fa-solid fa-heart" aria-hidden="true"></i>
                </span>
                <h3 class="mb-2 text-base font-medium text-gray-900">{{ __('Valeurs') }}</h3>
                <p class="text-sm leading-relaxed text-gray-600">{{ __('Intégrité, solidarité, excellence et engagement envers la communauté.') }}</p>
            </article>
        </div>
    </div>
</section>

<section class="bg-gray-50 px-6 py-14 lg:px-16">
    <div class="mx-auto max-w-7xl">
        <h2 class="mb-8 text-2xl font-medium text-gray-900">{{ __('Notre équipe') }}</h2>
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
            @for ($i = 1; $i <= 4; $i++)
                <article class="rounded-xl border border-gray-200 bg-white p-4">
                    <img src="https://i.pravatar.cc/300?img={{ $i+20 }}" class="mb-3 aspect-square w-full rounded-xl object-cover" alt="{{ __('Membre de l\'équipe') }}" width="300" height="300" loading="lazy">
                    <h3 class="text-sm font-medium text-gray-900">{{ __('Nom du membre :index', ['index' => $i]) }}</h3>
                    <p class="mt-1 text-xs text-gray-500">{{ __('Titre / poste') }}</p>
                </article>
            @endfor
        </div>
    </div>
</section>
@endsection
