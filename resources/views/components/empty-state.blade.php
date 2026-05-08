@props([
    'title' => 'Aucune donnée',
    'message' => 'Aucun contenu à afficher pour le moment.',
    'actionLabel' => null,
    'actionHref' => null,
])

<div class="rounded-2xl border border-dashed border-slate-300 bg-white p-10 text-center">
    <svg class="mx-auto mb-4 h-16 w-16 text-slate-300" viewBox="0 0 64 64" fill="none" aria-hidden="true">
        <rect x="8" y="10" width="48" height="44" rx="8" stroke="currentColor" stroke-width="2"/>
        <path d="M20 24H44M20 32H44M20 40H34" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
    </svg>
    <h3 class="mb-2 text-lg font-semibold text-slate-900">{{ $title }}</h3>
    <p class="mx-auto max-w-md text-sm text-slate-600">{{ $message }}</p>
    @if($actionLabel && $actionHref)
        <a href="{{ $actionHref }}" class="mt-5 inline-flex rounded-lg bg-blue-700 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-800">
            {{ $actionLabel }}
        </a>
    @endif
</div>
