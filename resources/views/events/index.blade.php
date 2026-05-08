@extends('layouts.public')

@section('title', __('Agenda des événements'))

@section('content')
<section class="bg-[--cerape-orange-light] px-6 py-14 lg:px-16">
    <div class="mx-auto max-w-7xl">
        <h1 class="text-3xl font-medium text-gray-900">{{ __('Agenda') }}</h1>
        <p class="mt-3 max-w-3xl text-sm leading-relaxed text-gray-500">{{ __('Rejoignez-nous lors de nos prochains événements, formations et actions sur le terrain.') }}</p>
    </div>
</section>

<section class="bg-gray-50 px-6 py-14 lg:px-16">
    <div class="mx-auto max-w-7xl">
        <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3">
            @forelse($events as $event)
                <article class="rounded-xl border border-gray-200 bg-white p-5">
                    <div class="mb-3 flex items-start justify-between gap-3">
                        <span class="rounded-full bg-[--cerape-orange-light] px-3 py-1 text-xs text-[--cerape-orange]">{{ $event->type }}</span>
                        <div class="shrink-0 text-right">
                            <p class="text-xl font-medium text-gray-900">{{ $event->date_heure->format('d') }}</p>
                            <p class="text-xs uppercase tracking-wide text-gray-500">{{ $event->date_heure->format('M Y') }}</p>
                        </div>
                    </div>

                    <h2 class="mb-2 text-base font-medium text-gray-900">{{ $event->titre }}</h2>
                    <p class="mb-4 line-clamp-3 text-sm text-gray-500">{{ $event->description }}</p>

                    <ul class="mb-5 space-y-2 text-xs text-gray-500">
                        <li class="flex items-center gap-2">
                            <i class="fa-solid fa-location-dot text-[--cerape-orange]" aria-hidden="true"></i>
                            <span>{{ $event->lieu }}</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fa-regular fa-clock text-[--cerape-orange]" aria-hidden="true"></i>
                            <span>{{ $event->date_heure->format('H:i') }}</span>
                        </li>
                        @if($event->capacite_max > 0)
                            <li class="flex items-center gap-2">
                                <i class="fa-solid fa-users text-[--cerape-orange]" aria-hidden="true"></i>
                                <span>{{ __(':count places max', ['count' => $event->capacite_max]) }}</span>
                            </li>
                        @endif
                    </ul>

                    @if($event->inscriptions_ouvertes)
                        <a href="{{ route('contact', ['sujet' => 'Inscription : '.$event->titre]) }}" class="inline-flex w-full items-center justify-center rounded-full border border-[--cerape-orange] px-4 py-2.5 text-sm text-[--cerape-orange] hover:bg-[--cerape-orange-light]">
                            {{ __('S\'inscrire') }}
                        </a>
                    @else
                        <button class="inline-flex w-full items-center justify-center rounded-full border border-gray-200 px-4 py-2.5 text-sm text-gray-400" disabled>
                            {{ __('Inscriptions fermées') }}
                        </button>
                    @endif
                </article>
            @empty
                <div class="rounded-xl border border-gray-200 bg-white p-6 text-sm text-gray-500">
                    {{ __('Revenez plus tard pour découvrir nos prochaines actions.') }}
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
