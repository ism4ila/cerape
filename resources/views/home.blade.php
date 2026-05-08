@extends('layouts.public')

@section('title', $siteSettings['site_tagline'])

@section('content')
<section class="bg-[--cerape-orange-light] px-6 py-16 lg:px-16">
    <div class="mx-auto grid max-w-7xl gap-10 lg:grid-cols-2 lg:items-center">
        <div>
            <span class="inline-flex items-center gap-2 rounded-full border border-gray-200 bg-white px-3 py-1 text-sm text-gray-600">
                <span class="h-2 w-2 rounded-full bg-[--cerape-orange]"></span>
                {{ __('Depuis 2005 au Cameroun') }}
            </span>
            <h1 class="mb-4 mt-6 text-3xl font-medium leading-snug text-gray-900 lg:text-4xl">
                {{ __('Bâtir un avenir par') }} <span class="text-[--cerape-orange]">{{ __('l\'éducation') }}</span> {{ __('et le développement') }}
            </h1>
            <p class="mb-6 max-w-md text-base leading-relaxed text-gray-500">
                {{ __('Nous accompagnons les communautés avec des projets concrets qui renforcent l\'éducation, la santé et l\'autonomie locale.') }}
            </p>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('don') }}" class="rounded-full bg-[--cerape-orange] px-6 py-3 text-sm text-white hover:opacity-90">
                    {{ __('Faire un don') }}
                </a>
                <a href="{{ route('about') }}" class="rounded-full border-2 border-[--cerape-orange] px-6 py-3 text-sm text-[--cerape-orange]">
                    {{ __('En savoir plus') }}
                </a>
            </div>
        </div>
        <div class="relative">
            <div class="overflow-hidden rounded-2xl border border-gray-200">
                <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" alt="{{ __('Élèves en classe') }}" loading="lazy" class="aspect-video h-full w-full object-cover">
            </div>
            <div class="absolute bottom-3 left-3 right-3 flex items-center gap-3 rounded-xl border border-gray-200 bg-white/90 p-3">
                <span class="flex h-10 w-10 items-center justify-center rounded-full bg-[--cerape-orange-light] text-[--cerape-orange]">
                    <i class="fa-solid fa-people-group" aria-hidden="true"></i>
                </span>
                <div>
                    <p class="text-sm text-gray-900">{{ __('1 200+ bénéficiaires en 2024') }}</p>
                    <p class="text-xs text-gray-500">{{ __('Impact direct sur le terrain') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="border-y border-gray-100 bg-white">
    <div class="mx-auto grid max-w-7xl grid-cols-2 md:grid-cols-4">
        @php
            $statMap = [
                __('Bénéficiaires') => $stats->firstWhere('label', 'Bénéficiaires')?->count ?? 43500,
                __('Domaines d\'action') => $stats->firstWhere('label', 'Domaines')?->count ?? 7,
                __('Années d\'expérience') => $stats->firstWhere('label', 'Années')?->count ?? 19,
                __('Partenaires') => $stats->firstWhere('label', 'Partenaires')?->count ?? 12,
            ];
        @endphp
        @foreach($statMap as $label => $value)
            <div class="border-r border-gray-100 py-5 text-center last:border-r-0">
                <p class="text-2xl font-medium text-[--cerape-orange]">{{ number_format($value, 0, ',', ' ') }}</p>
                <p class="mt-1 text-xs text-gray-400">{{ $label }}</p>
            </div>
        @endforeach
    </div>
</section>

<section class="bg-white px-6 py-14 lg:px-16">
    <div class="mx-auto max-w-7xl">
        <div class="mb-8 flex flex-col items-start justify-between gap-3 sm:flex-row sm:items-end">
            <h2 class="text-xl font-medium text-gray-900">{{ __('Nos domaines d\'intervention') }}</h2>
            <a href="{{ route('domaines.index') }}" class="text-sm text-[--cerape-orange]">{{ __('Voir tous →') }}</a>
        </div>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($domaines as $domaine)
                @php
                    $iconBackground = match(strtolower($domaine->nom)) {
                        'éducation', 'education' => 'bg-[--cerape-green-light] text-[--cerape-green]',
                        'santé', 'sante' => 'bg-[--cerape-orange-light] text-[--cerape-orange]',
                        default => 'bg-[--cerape-amber-light] text-[--cerape-amber]',
                    };
                @endphp
                <a href="{{ route('domaines.show', $domaine->slug) }}" class="cursor-pointer rounded-2xl border border-gray-100 bg-gray-50 p-5 transition-colors hover:border-[--cerape-orange]">
                    <span class="mb-3 flex h-10 w-10 items-center justify-center rounded-xl {{ $iconBackground }}">
                        <i class="fa-solid fa-{{ $domaine->icone ?? 'star' }}" aria-hidden="true"></i>
                    </span>
                    <h3 class="mb-1 text-sm font-medium text-gray-900">{{ $domaine->nom }}</h3>
                    <p class="line-clamp-3 text-xs leading-relaxed text-gray-500">{{ $domaine->description }}</p>
                </a>
            @endforeach
        </div>
    </div>
</section>

<section class="bg-gray-50 px-6 py-14 lg:px-16">
    <div class="mx-auto max-w-7xl">
        <div class="mb-8 flex flex-col items-start justify-between gap-3 sm:flex-row sm:items-end">
            <h2 class="text-xl font-medium text-gray-900">{{ __('Projets récents') }}</h2>
            <a href="{{ route('projets.index') }}" class="text-sm text-[--cerape-orange]">{{ __('Voir tous →') }}</a>
        </div>
        <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3">
            @foreach($recentProjets as $projet)
                @php
                    $categoryClass = match(strtolower((string) $projet->domaine)) {
                        'éducation', 'education' => 'bg-[--cerape-green-light] text-[--cerape-green]',
                        'santé', 'sante' => 'bg-[--cerape-amber-light] text-[--cerape-amber]',
                        default => 'bg-[--cerape-orange-light] text-[--cerape-orange]',
                    };
                    $progression = (int) ($projet->progression ?? 0);
                @endphp
                <article class="overflow-hidden rounded-2xl border border-gray-100 bg-white">
                    @if(!empty($projet->images[0]))
                        <x-image :src="$projet->images[0]" :alt="__('Illustration de projet')" class="aspect-video w-full object-cover" :width="800" :height="450" />
                    @else
                        <div class="aspect-video w-full bg-gray-100"></div>
                    @endif
                    <div class="p-4">
                        <span class="mb-3 inline-block rounded-full px-3 py-1 text-xs font-medium {{ $categoryClass }}">{{ $projet->domaine ?? __('Projet') }}</span>
                        <h3 class="mb-2 text-sm font-medium leading-snug text-gray-900">{{ $projet->titre }}</h3>
                        <p class="flex items-center gap-1 text-xs text-gray-400">
                            <i class="fa-regular fa-clock" aria-hidden="true"></i>
                            {{ optional($projet->created_at)->format('d/m/Y') }}
                        </p>
                        @if($progression > 0)
                            <div class="mt-3 h-1 rounded-full bg-gray-100">
                                <div class="h-1 rounded-full bg-[--cerape-orange]" @style(['width: '.max(0, min(100, $progression)).'%;'])></div>
                            </div>
                            <p class="mt-2 text-xs text-gray-400">{{ __(':value% complété', ['value' => $progression]) }}</p>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="bg-[--cerape-orange] px-6 py-14 lg:px-16">
    <div class="mx-auto grid max-w-7xl gap-10 lg:grid-cols-2 lg:items-center">
        <div>
            <h2 class="mb-3 text-2xl font-medium leading-snug text-white">
                {{ __('Votre soutien change des vies sur le terrain') }}
            </h2>
            <p class="mb-6 text-sm leading-relaxed text-white/80">
                {{ __('Chaque contribution finance des actions concrètes pour l\'éducation, la santé communautaire et le développement local.') }}
            </p>
            <div class="flex flex-wrap gap-2">
                <span class="flex items-center gap-1 rounded-full border border-white/30 bg-white/15 px-3 py-1 text-xs text-white">
                    <i class="fa-solid fa-lock" aria-hidden="true"></i>{{ __('Don sécurisé') }}
                </span>
                <span class="flex items-center gap-1 rounded-full border border-white/30 bg-white/15 px-3 py-1 text-xs text-white">
                    <i class="fa-solid fa-file-circle-check" aria-hidden="true"></i>{{ __('Transparent') }}
                </span>
                <span class="flex items-center gap-1 rounded-full border border-white/30 bg-white/15 px-3 py-1 text-xs text-white">
                    <i class="fa-solid fa-receipt" aria-hidden="true"></i>{{ __('Reçu fiscal') }}
                </span>
            </div>
        </div>
        <div class="rounded-2xl bg-white p-6" x-data="{ selected: '10000', custom: '' }">
            <h3 class="mb-4 text-sm font-medium text-gray-900">{{ __('Choisissez votre montant') }}</h3>
            <form action="{{ route('don.store') }}" method="POST" data-don-form>
                @csrf
                <div class="mb-3 grid grid-cols-3 gap-2">
                    @foreach([5000, 10000, 25000] as $amount)
                        <label class="cursor-pointer">
                            <input type="radio" class="btn-check sr-only" name="montant" value="{{ $amount }}" x-model="selected">
                            <span class="block rounded-xl bg-[--cerape-orange-light] py-2 text-center text-sm font-medium text-[--cerape-orange]" :class="selected === '{{ $amount }}' && custom === '' ? 'border-2 border-[--cerape-orange] bg-white' : 'border border-transparent'">
                                {{ number_format($amount, 0, ',', ' ') }}
                            </span>
                        </label>
                    @endforeach
                </div>
                <input type="number" class="mb-3 w-full rounded-xl border border-gray-200 px-3 py-2.5 text-sm text-gray-700 outline-none" placeholder="{{ __('Ou saisissez un montant personnalisé (FCFA)') }}" data-custom-amount x-model="custom" @input="if(custom !== '') selected = ''" aria-label="{{ __('Montant personnalisé') }}">
                <input type="hidden" name="montant_custom" data-hidden-custom-amount>
                <button type="submit" class="w-full rounded-full bg-[--cerape-orange] py-3 text-sm font-medium text-white">
                    {{ __('Faire un don maintenant') }}
                </button>
                <p class="mt-2 text-center text-xs text-gray-400">{{ __('Paiement sécurisé · MTN Money, Orange Money, CB') }}</p>
            </form>
        </div>
    </div>
</section>
@endsection
