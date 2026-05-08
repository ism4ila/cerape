@extends('layouts.public')

@section('title', __('Nos domaines d\'action'))

@section('content')
<section class="bg-[--cerape-orange-light] px-6 py-14 lg:px-16">
    <div class="mx-auto max-w-7xl">
        <h1 class="text-3xl font-medium text-gray-900">{{ __('Nos domaines d\'action') }}</h1>
        <p class="mt-3 max-w-3xl text-sm leading-relaxed text-gray-500">{{ __('Découvrez comment nous agissons chaque jour pour améliorer les conditions de vie et l\'accès à l\'éducation au Cameroun.') }}</p>
    </div>
</section>

<section class="bg-white px-6 py-14 lg:px-16">
    <div class="mx-auto max-w-7xl">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            @forelse ($domaines as $domaine)
                @php
                    $iconBackground = match(strtolower($domaine->nom)) {
                        'éducation', 'education' => 'bg-[--cerape-green-light] text-[--cerape-green]',
                        'santé', 'sante' => 'bg-[--cerape-orange-light] text-[--cerape-orange]',
                        default => 'bg-[--cerape-amber-light] text-[--cerape-amber]',
                    };
                @endphp
                <article class="rounded-xl border border-gray-200 bg-gray-50 p-5">
                    <span class="mb-3 flex h-10 w-10 items-center justify-center rounded-xl {{ $iconBackground }}">
                        <i class="{{ $domaine->icone ?? 'fa-solid fa-folder' }}" aria-hidden="true"></i>
                    </span>
                    <h2 class="mb-2 text-sm font-medium text-gray-900">{{ $domaine->nom }}</h2>
                    <p class="mb-4 line-clamp-3 text-xs leading-relaxed text-gray-500">{{ Str::limit($domaine->description, 100) }}</p>
                    <a href="{{ route('domaines.show', $domaine->slug) }}" class="inline-flex rounded-full border border-gray-200 px-3 py-1.5 text-xs text-gray-700 hover:border-[--cerape-orange] hover:text-[--cerape-orange]">
                        {{ __('En savoir plus') }}
                    </a>
                </article>
            @empty
                <div class="rounded-xl border border-gray-200 bg-white p-6 text-sm text-gray-500">
                    {{ __('Aucun domaine d\'action trouvé.') }}
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
