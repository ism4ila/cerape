@extends('layouts.public')

@section('title', $article->titre)

@section('content')
<section class="bg-white px-6 py-14 lg:px-16">
    <div class="mx-auto max-w-4xl">
        <article class="overflow-hidden rounded-xl border border-gray-200 bg-white">
            @if($article->image_url)
                <x-image :src="$article->image_url" :alt="$article->titre" class="aspect-video w-full object-cover" :width="1200" :height="675" />
            @else
                <div class="flex aspect-video w-full items-center justify-center bg-gray-100 text-gray-400">
                    <i class="fa-regular fa-image" aria-hidden="true"></i>
                </div>
            @endif
            <div class="p-5 lg:p-8">
                <div class="mb-4 flex flex-wrap items-center gap-3 text-xs text-gray-400">
                    <span class="rounded-full bg-[--cerape-orange-light] px-3 py-1 text-[--cerape-orange]">{{ $article->categorie }}</span>
                    <span class="flex items-center gap-1"><i class="fa-regular fa-calendar" aria-hidden="true"></i>{{ $article->date_publication ? $article->date_publication->format('d M Y') : $article->created_at->format('d M Y') }}</span>
                    <span class="flex items-center gap-1"><i class="fa-regular fa-user" aria-hidden="true"></i>{{ __('Par :author', ['author' => $article->auteur]) }}</span>
                </div>
                <h1 class="mb-6 break-words text-3xl font-medium text-gray-900 lg:text-4xl">{{ $article->titre }}</h1>

                <div class="prose prose-sm max-w-none text-gray-600 lg:prose-base">
                    {{-- Approved raw HTML context: article body is sanitized through Purify before rendering. --}}
                    {!! Purify::clean($article->contenu) !!}
                </div>

                @if(!empty($article->tags))
                    <div class="mt-8 border-t border-gray-200 pt-5">
                        <h2 class="mb-3 text-sm font-medium text-gray-900">{{ __('Mots-clés') }}</h2>
                        <div class="flex flex-wrap gap-2">
                            @foreach($article->tags as $tag)
                                <span class="rounded-full border border-gray-200 px-3 py-1 text-xs text-gray-600">{{ $tag }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </article>
    </div>
</section>
@endsection
