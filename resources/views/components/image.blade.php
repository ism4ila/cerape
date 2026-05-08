@props([
    'src' => null,
    'alt' => '',
    'fallback' => 'https://via.placeholder.com/800x500?text=Image',
    'width' => 800,
    'height' => 500,
    'lazy' => true,
])

<img
    src="{{ $src ?: $fallback }}"
    alt="{{ $alt }}"
    width="{{ $width }}"
    height="{{ $height }}"
    @if($lazy) loading="lazy" @endif
    {{ $attributes }}
    onerror="this.onerror=null;this.src='{{ $fallback }}';"
/>
