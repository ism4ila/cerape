@props([
    'variant' => 'primary',
    'size' => 'md',
    'type' => 'button',
    'disabled' => false,
])

@php
    $base = 'inline-flex items-center justify-center gap-2 rounded-lg font-semibold transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:opacity-60 disabled:cursor-not-allowed';
    $sizes = [
        'sm' => 'px-3 py-2 text-sm',
        'md' => 'px-4 py-2.5 text-sm',
        'lg' => 'px-5 py-3 text-base',
    ];
    $variants = [
        'primary' => 'bg-blue-700 text-white hover:bg-blue-800 focus-visible:ring-blue-700',
        'secondary' => 'bg-slate-100 text-slate-900 hover:bg-slate-200 focus-visible:ring-slate-500',
        'danger' => 'bg-red-600 text-white hover:bg-red-700 focus-visible:ring-red-600',
    ];
@endphp

<button
    type="{{ $type }}"
    {{ $disabled ? 'disabled' : '' }}
    {{ $attributes->merge(['class' => $base.' '.$sizes[$size].' '.$variants[$variant]]) }}
>
    {{ $slot }}
</button>
