@props([
    'title' => null,
])

<section {{ $attributes->merge(['class' => 'rounded-2xl border border-slate-200 bg-white shadow-sm']) }}>
    @if($title)
        <header class="border-b border-slate-200 px-5 py-4">
            <h3 class="text-base font-semibold text-slate-900">{{ $title }}</h3>
        </header>
    @endif

    <div class="p-5">
        {{ $slot }}
    </div>

    @isset($footer)
        <footer class="border-t border-slate-200 px-5 py-4">
            {{ $footer }}
        </footer>
    @endisset
</section>
