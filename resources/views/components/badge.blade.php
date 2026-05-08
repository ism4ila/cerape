@props([
    'color' => 'gray',
])

@php
    $colors = [
        'gray' => 'bg-slate-100 text-slate-700',
        'blue' => 'bg-blue-100 text-blue-700',
        'green' => 'bg-emerald-100 text-emerald-700',
        'red' => 'bg-red-100 text-red-700',
        'yellow' => 'bg-amber-100 text-amber-700',
        'purple' => 'bg-violet-100 text-violet-700',
    ];
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold '.$colors[$color]]) }}>
    {{ $slot }}
</span>
