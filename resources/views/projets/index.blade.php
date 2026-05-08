@extends('layouts.public')

@section('title', __('Nos projets et réalisations'))

@section('content')
<section class="bg-gray-50 px-6 py-14 lg:px-16">
    <div class="mx-auto max-w-7xl">
        <div class="mb-8">
            <h1 class="text-3xl font-medium text-gray-900">{{ __('Nos projets et réalisations') }}</h1>
            <p class="mt-3 max-w-3xl text-sm leading-relaxed text-gray-500">
                {{ __('Découvrez les projets concrets menés sur le terrain pour améliorer l\'accès à l\'éducation et soutenir les communautés.') }}
            </p>
        </div>
        
        <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($projets as $projet)
                @php
                    $categoryClass = match(strtolower((string) $projet->domaine)) {
                        'éducation', 'education' => 'bg-[--cerape-green-light] text-[--cerape-green]',
                        'santé', 'sante' => 'bg-[--cerape-amber-light] text-[--cerape-amber]',
                        default => 'bg-[--cerape-orange-light] text-[--cerape-orange]',
                    };
                @endphp
                <article class="overflow-hidden rounded-xl border border-gray-200 bg-white">
                    @if($projet->images && count($projet->images) > 0)
                        <x-image :src="$projet->images[0]" :alt="$projet->titre" class="aspect-video w-full object-cover" :width="800" :height="450" />
                    @else
                        <div class="flex aspect-video w-full items-center justify-center bg-gray-100 text-gray-400">
                            <i class="fa-solid fa-image" aria-hidden="true"></i>
                        </div>
                    @endif
                    <div class="p-4">
                        <div class="mb-2 flex items-center justify-between gap-2">
                            <span class="rounded-full px-3 py-1 text-xs font-medium {{ $categoryClass }}">{{ $projet->domaine ?? __('Projet') }}</span>
                            <span class="flex min-w-0 items-center gap-1 text-xs text-gray-400">
                                <i class="fa-solid fa-location-dot shrink-0" aria-hidden="true"></i>
                                <span class="truncate">{{ $projet->lieu }}</span>
                            </span>
                        </div>
                        <h2 class="mb-2 text-sm font-medium leading-snug text-gray-900">{{ $projet->titre }}</h2>
                        <p class="mb-4 text-xs leading-relaxed text-gray-500">{{ Str::limit($projet->description, 110) }}</p>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-400">{{ $projet->statut }}</span>
                            <a href="{{ route('projets.show', $projet->slug) }}" class="rounded-full border border-gray-200 px-3 py-1 text-xs text-gray-700 hover:border-[--cerape-orange] hover:text-[--cerape-orange]">
                                {{ __('Voir le détail') }}
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="rounded-xl border border-gray-200 bg-white p-6 text-sm text-gray-500">
                    {{ __('Aucun projet n\'est disponible actuellement.') }}
                </div>
            @endforelse
        </div>

        <div class="mt-8 flex justify-center">
            {{ $projets->links() }}
        </div>
    </div>
</section>
@endsection
