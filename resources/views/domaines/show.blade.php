@extends('layouts.public')

@section('title', $domaine->nom)

@section('content')
<section class="bg-white px-6 py-14 lg:px-16">
    <div class="mx-auto grid max-w-7xl gap-8 lg:grid-cols-3">
        <article class="lg:col-span-2 rounded-xl border border-gray-200 bg-white p-6">
            <div class="mb-4 flex items-center gap-3">
                <span class="flex h-12 w-12 items-center justify-center rounded-xl bg-[--cerape-orange-light] text-[--cerape-orange]">
                    <i class="{{ $domaine->icone ?? 'fa-solid fa-folder' }}" aria-hidden="true"></i>
                </span>
                <h1 class="break-words text-3xl font-medium text-gray-900">{{ $domaine->nom }}</h1>
            </div>
            <h2 class="mb-3 text-lg font-medium text-gray-900">{{ __('Description du domaine') }}</h2>
            <div class="text-sm leading-relaxed text-gray-600">
                {{-- Approved raw HTML context: newline formatting is generated from escaped plain text content. --}}
                {!! nl2br(e($domaine->description)) !!}
            </div>
        </article>

        <aside class="space-y-4">
            <div class="rounded-xl border border-gray-200 bg-gray-50 p-5">
                <h3 class="mb-3 text-sm font-medium text-gray-900">{{ __('Soutenir ce domaine') }}</h3>
                <p class="mb-4 text-sm text-gray-600">
                    {{ __('Votre contribution peut faire la différence dans nos actions liées à :name.', ['name' => $domaine->nom]) }}
                </p>
                <a href="{{ route('don', ['cause' => $domaine->nom]) }}" class="inline-flex w-full items-center justify-center gap-2 rounded-full bg-[--cerape-orange] px-4 py-2.5 text-sm text-white hover:opacity-90">
                    <i class="fa-solid fa-heart" aria-hidden="true"></i>{{ __('Faire un don') }}
                </a>
            </div>
            <div class="rounded-xl border border-gray-200 bg-white p-5">
                <h3 class="mb-3 text-sm font-medium text-gray-900">{{ __('Partager') }}</h3>
                <div class="flex gap-2">
                    @if(!empty($siteSettings['facebook_url']))
                        <a href="{{ $siteSettings['facebook_url'] }}" target="_blank" rel="noopener" class="flex h-9 w-9 items-center justify-center rounded-full border border-gray-200 text-gray-500 hover:text-[--cerape-orange]" aria-label="Facebook"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
                    @endif
                    @if(!empty($siteSettings['twitter_url']))
                        <a href="{{ $siteSettings['twitter_url'] }}" target="_blank" rel="noopener" class="flex h-9 w-9 items-center justify-center rounded-full border border-gray-200 text-gray-500 hover:text-[--cerape-orange]" aria-label="Twitter"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                    @endif
                    @if(!empty($siteSettings['whatsapp_number']))
                        <a href="https://wa.me/{{ preg_replace('/\D/', '', $siteSettings['whatsapp_number']) }}" target="_blank" rel="noopener" class="flex h-9 w-9 items-center justify-center rounded-full border border-gray-200 text-gray-500 hover:text-[--cerape-orange]" aria-label="WhatsApp"><i class="fab fa-whatsapp" aria-hidden="true"></i></a>
                    @endif
                </div>
            </div>
        </aside>
    </div>
</section>
@endsection
