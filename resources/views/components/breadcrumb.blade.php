@props([
    'items' => [],
])

@if(count($items) > 0)
    <nav aria-label="Fil d'Ariane" class="mb-4">
        <ol class="flex flex-wrap items-center gap-2 text-sm text-slate-500">
            @foreach($items as $index => $item)
                <li class="flex items-center gap-2">
                    @if($index > 0)
                        <i class="fa-solid fa-chevron-right text-xs"></i>
                    @endif
                    @if(!empty($item['url']) && $index < count($items) - 1)
                        <a href="{{ $item['url'] }}" class="hover:text-slate-800 hover:underline">{{ $item['label'] }}</a>
                    @else
                        <span class="font-medium text-slate-700" aria-current="page">{{ $item['label'] }}</span>
                    @endif
                </li>
            @endforeach
        </ol>
    </nav>
@endif
