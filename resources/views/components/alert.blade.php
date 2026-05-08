@props([
    'type' => 'info',
    'dismissible' => true,
])

@php
    $styles = [
        'success' => 'bg-emerald-50 text-emerald-800 border-emerald-200',
        'error' => 'bg-red-50 text-red-800 border-red-200',
        'warning' => 'bg-amber-50 text-amber-800 border-amber-200',
        'info' => 'bg-sky-50 text-sky-800 border-sky-200',
    ];
    $icons = [
        'success' => 'fa-solid fa-circle-check',
        'error' => 'fa-solid fa-circle-xmark',
        'warning' => 'fa-solid fa-triangle-exclamation',
        'info' => 'fa-solid fa-circle-info',
    ];
@endphp

<div x-data="{ open: true }" x-show="open" class="rounded-lg border p-4 {{ $styles[$type] }}" role="alert">
    <div class="flex items-start gap-3">
        <i class="{{ $icons[$type] }} mt-0.5"></i>
        <div class="flex-1 text-sm">{{ $slot }}</div>
        @if($dismissible)
            <button type="button" class="text-current/70 hover:text-current" @click="open = false" aria-label="Fermer l'alerte">
                <i class="fa-solid fa-xmark"></i>
            </button>
        @endif
    </div>
</div>
