@extends('layouts.public')

@section('title', $projet->titre)

@section('content')
<section class="bg-white px-6 py-14 lg:px-16">
    <div class="mx-auto grid max-w-7xl gap-8 lg:grid-cols-3">
        <article class="lg:col-span-2 rounded-xl border border-gray-200 bg-white p-6">
            <h1 class="mb-3 break-words text-3xl font-medium text-gray-900">{{ $projet->titre }}</h1>
            <div class="mb-5 flex flex-wrap items-center gap-3 text-xs text-gray-400">
                <span class="rounded-full bg-[--cerape-orange-light] px-3 py-1 text-[--cerape-orange]">{{ $projet->domaine }}</span>
                <span class="flex items-center gap-1"><i class="fa-solid fa-location-dot" aria-hidden="true"></i>{{ $projet->lieu }}</span>
                <span class="flex items-center gap-1"><i class="fa-solid fa-calendar" aria-hidden="true"></i>{{ $projet->date_debut?->format('d/m/Y') }}</span>
            </div>

            @if($projet->images && count($projet->images) > 0)
                <div class="mb-6 overflow-hidden rounded-xl border border-gray-200">
                    <x-image :src="$projet->images[0]" :alt="$projet->titre" class="aspect-video w-full object-cover" :width="1200" :height="675" />
                </div>
            @endif

            <h2 class="mb-3 text-lg font-medium text-gray-900">{{ __('Description du projet') }}</h2>
            <div class="text-sm leading-relaxed text-gray-600">
                {{-- Approved raw HTML context: newline formatting is generated from escaped project description text. --}}
                {!! nl2br(e($projet->description)) !!}
            </div>

            @if($projet->images && count($projet->images) > 1)
                <h3 class="mb-3 mt-8 text-base font-medium text-gray-900">{{ __('Galerie') }}</h3>
                <div class="grid grid-cols-2 gap-3 md:grid-cols-3">
                    @foreach(array_slice($projet->images, 1) as $image)
                        <div class="overflow-hidden rounded-xl border border-gray-200">
                            <img src="{{ $image }}" alt="{{ __('Image du projet') }}" loading="lazy" class="aspect-square w-full object-cover">
                        </div>
                    @endforeach
                </div>
            @endif
        </article>

        <aside class="space-y-4">
            <div class="rounded-xl border border-gray-200 bg-gray-50 p-5">
                <h3 class="mb-4 text-sm font-medium text-gray-900">{{ __('Fiche technique') }}</h3>
                <ul class="space-y-3 text-sm text-gray-600">
                    <li class="flex items-center justify-between">
                        <span>{{ __('Statut') }}</span>
                        <span class="text-gray-900">{{ $projet->statut }}</span>
                    </li>
                    <li class="flex items-center justify-between gap-3">
                        <span>{{ __('Lieu') }}</span>
                        <span class="min-w-0 break-words text-right text-gray-900">{{ $projet->lieu }}</span>
                    </li>
                    <li class="flex items-center justify-between">
                        <span>{{ __('Bénéficiaires') }}</span>
                        <span class="text-right text-gray-900">{{ number_format((int) $projet->beneficiaires, 0, ',', ' ') }}</span>
                    </li>
                </ul>
                <a href="{{ route('don', ['cause' => $projet->titre]) }}" class="mt-5 inline-flex w-full items-center justify-center gap-2 rounded-full bg-[--cerape-orange] px-4 py-2.5 text-sm text-white hover:opacity-90">
                    <i class="fa-solid fa-heart" aria-hidden="true"></i>{{ __('Soutenir ce projet') }}
                </a>
            </div>

            @if($projet->partenaires && count($projet->partenaires) > 0)
                <div class="rounded-xl border border-gray-200 bg-white p-5">
                    <h3 class="mb-3 text-sm font-medium text-gray-900">{{ __('Partenaires') }}</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($projet->partenaires as $partenaire)
                            <span class="rounded-full border border-gray-200 px-3 py-1 text-xs text-gray-600">{{ $partenaire }}</span>
                        @endforeach
                    </div>
                </div>
            @endif
        </aside>
    </div>
</section>
@endsection
