@extends('layouts.public')

@section('title', __('Actualités'))

@section('content')
<section class="bg-gray-50 px-6 py-14 lg:px-16">
    <div class="mx-auto max-w-7xl">
        <div class="mb-8">
            <h1 class="text-3xl font-medium text-gray-900">{{ __('Actualités') }}</h1>
            <p class="mt-3 max-w-3xl text-sm leading-relaxed text-gray-500">
                {{ __('Suivez nos dernières activités, événements et réflexions sur l\'éducation au Cameroun.') }}
            </p>
        </div>

        <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($articles as $article)
                <article class="overflow-hidden rounded-xl border border-gray-200 bg-white">
                    @if($article->image_url)
                        <x-image :src="$article->image_url" :alt="$article->titre" class="aspect-video w-full object-cover" :width="800" :height="450" />
                    @else
                        <div class="flex aspect-video w-full items-center justify-center bg-gray-100 text-gray-400">
                            <i class="fa-solid fa-newspaper" aria-hidden="true"></i>
                        </div>
                    @endif
                    <div class="p-4">
                        <div class="mb-3 flex items-center justify-between gap-2">
                            <span class="rounded-full bg-[--cerape-orange-light] px-3 py-1 text-xs text-[--cerape-orange]">{{ $article->categorie }}</span>
                            <span class="flex items-center gap-1 text-xs text-gray-400">
                                <i class="fa-solid fa-calendar" aria-hidden="true"></i>{{ optional($article->date_publication)->format('d/m/Y') }}
                            </span>
                        </div>
                        <h2 class="mb-2 text-sm font-medium leading-snug text-gray-900">{{ $article->titre }}</h2>
                        <p class="mb-4 text-xs leading-relaxed text-gray-500">{{ Str::limit(strip_tags($article->contenu), 110) }}</p>
                        <div class="flex items-center justify-between gap-3">
                            <span class="truncate text-xs text-gray-400">
                                <i class="fa-solid fa-user mr-1" aria-hidden="true"></i>{{ $article->auteur }}
                            </span>
                            <a href="{{ route('articles.show', $article->slug) }}" class="inline-flex shrink-0 items-center gap-1 rounded-full border border-gray-200 px-3 py-1 text-xs text-gray-700 hover:border-[--cerape-orange] hover:text-[--cerape-orange]">
                                {{ __('Lire la suite') }} <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="rounded-xl border border-gray-200 bg-white p-6 text-sm text-gray-500">
                    {{ __('La liste des actualités est vide pour le moment. Revenez prochainement.') }}
                </div>
            @endforelse
        </div>

        <div class="mt-8 flex justify-center">
            {{ $articles->links() }}
        </div>
    </div>
</section>
@endsection
