@extends('layouts.public')

@section('title', __('Confidentialité'))

@section('content')
<section class="bg-[--cerape-orange-light] px-6 py-14 lg:px-16">
    <div class="mx-auto max-w-4xl">
        <h1 class="text-3xl font-medium text-gray-900">{{ __('Confidentialité') }}</h1>
        <p class="mt-3 text-sm leading-relaxed text-gray-600">
            {{ __('Nous attachons une grande importance à la protection de vos données personnelles et à la transparence de leur utilisation.') }}
        </p>
    </div>
</section>

<section class="bg-white px-6 py-14 lg:px-16">
    <div class="mx-auto max-w-4xl space-y-8 rounded-xl border border-gray-200 bg-white p-6 lg:p-8">
        <article>
            <h2 class="mb-2 text-lg font-medium text-gray-900">{{ __('Données collectées') }}</h2>
            <p class="text-sm leading-relaxed text-gray-600">
                {{ __('Nous collectons uniquement les informations nécessaires au traitement des dons, des demandes de contact et à l\'amélioration de nos services.') }}
            </p>
        </article>

        <article>
            <h2 class="mb-2 text-lg font-medium text-gray-900">{{ __('Utilisation des données') }}</h2>
            <p class="text-sm leading-relaxed text-gray-600">
                {{ __('Vos données sont utilisées exclusivement dans le cadre des activités du CERAPE, notamment pour répondre à vos demandes et assurer le suivi de nos actions.') }}
            </p>
        </article>

        <article>
            <h2 class="mb-2 text-lg font-medium text-gray-900">{{ __('Protection et conservation') }}</h2>
            <p class="text-sm leading-relaxed text-gray-600">
                {{ __('Nous mettons en œuvre des mesures de sécurité adaptées pour protéger vos données et nous les conservons uniquement pendant la durée nécessaire.') }}
            </p>
        </article>

        <article>
            <h2 class="mb-2 text-lg font-medium text-gray-900">{{ __('Vos droits') }}</h2>
            <p class="text-sm leading-relaxed text-gray-600">
                {{ __('Vous pouvez demander l\'accès, la rectification ou la suppression de vos données en nous contactant via la page de contact.') }}
            </p>
        </article>
    </div>
</section>
@endsection
