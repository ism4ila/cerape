@extends('layouts.public')

@section('title', __('Contactez-nous'))

@section('content')
<section class="px-6 py-14 lg:px-16">
    <div class="mx-auto grid max-w-7xl gap-10 lg:grid-cols-2">
        <div>
            <h1 class="mb-6 text-3xl font-medium text-gray-900">{{ __('Contactez-nous') }}</h1>
            <p class="mb-8 text-sm text-gray-500">{{ __('Une question, un partenariat ou envie de rejoindre l\'aventure ? Écrivez-nous.') }}</p>
            <div class="space-y-6">
                <div class="flex items-start gap-3">
                    <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-[--cerape-orange-light] text-[--cerape-orange]">
                        <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
                    </span>
                    <div>
                        <p class="text-xs font-medium tracking-wide text-gray-400">{{ __('SIÈGE SOCIAL') }}</p>
                        <p class="mt-0.5 text-sm text-gray-900">{{ $siteSettings['contact_address'] }}</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-[--cerape-green-light] text-[--cerape-green]">
                        <i class="fa-solid fa-phone" aria-hidden="true"></i>
                    </span>
                    <div>
                        <p class="text-xs font-medium tracking-wide text-gray-400">{{ __('TÉLÉPHONE') }}</p>
                        <p class="mt-0.5 text-sm text-gray-900">{{ $siteSettings['contact_phone'] }}</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-[--cerape-amber-light] text-[--cerape-amber]">
                        <i class="fa-solid fa-envelope" aria-hidden="true"></i>
                    </span>
                    <div>
                        <p class="text-xs font-medium tracking-wide text-gray-400">{{ __('EMAIL') }}</p>
                        <p class="mt-0.5 text-sm text-gray-900">{{ $siteSettings['contact_email'] }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="rounded-xl border border-gray-200 bg-white p-6">
            <h2 class="mb-4 text-sm font-medium text-gray-900">{{ __('Envoyez-nous un message') }}</h2>
            <form action="{{ route('contact.store') }}" method="POST" x-data="{ submitting: false }" @submit="submitting = true">
                @csrf
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label for="nom" class="mb-1 block text-xs text-gray-500">{{ __('Nom complet') }} <span class="text-[--cerape-orange]">*</span></label>
                        <input type="text" class="w-full rounded-xl border border-gray-200 px-3 py-2.5 text-sm outline-none focus:border-[--cerape-orange] focus:ring-0 @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom') }}" required aria-required="true" aria-describedby="nom-error" aria-invalid="{{ $errors->has('nom') ? 'true' : 'false' }}">
                        @error('nom') <p id="nom-error" class="invalid-feedback">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="email" class="mb-1 block text-xs text-gray-500">{{ __('Adresse email') }} <span class="text-[--cerape-orange]">*</span></label>
                        <input type="email" class="w-full rounded-xl border border-gray-200 px-3 py-2.5 text-sm outline-none focus:border-[--cerape-orange] focus:ring-0 @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required aria-required="true" aria-describedby="email-error" aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}">
                        @error('email') <p id="email-error" class="invalid-feedback">{{ $message }}</p> @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="sujet" class="mb-1 block text-xs text-gray-500">{{ __('Sujet') }} <span class="text-[--cerape-orange]">*</span></label>
                        <input type="text" class="w-full rounded-xl border border-gray-200 px-3 py-2.5 text-sm outline-none focus:border-[--cerape-orange] focus:ring-0 @error('sujet') is-invalid @enderror" id="sujet" name="sujet" value="{{ old('sujet', request('sujet')) }}" required aria-required="true" aria-describedby="sujet-error" aria-invalid="{{ $errors->has('sujet') ? 'true' : 'false' }}">
                        @error('sujet') <p id="sujet-error" class="invalid-feedback">{{ $message }}</p> @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="message" class="mb-1 block text-xs text-gray-500">{{ __('Votre message') }} <span class="text-[--cerape-orange]">*</span></label>
                        <textarea class="h-28 w-full resize-y rounded-xl border border-gray-200 px-3 py-2.5 text-sm outline-none focus:border-[--cerape-orange] focus:ring-0 @error('message') is-invalid @enderror" id="message" name="message" rows="5" required aria-required="true" aria-describedby="message-error" aria-invalid="{{ $errors->has('message') ? 'true' : 'false' }}">{{ old('message') }}</textarea>
                        @error('message') <p id="message-error" class="invalid-feedback">{{ $message }}</p> @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <button type="submit" class="flex items-center gap-2 rounded-full bg-[--cerape-orange] px-6 py-3 text-sm font-medium text-white" :disabled="submitting">
                            <i class="fa-solid fa-paper-plane" aria-hidden="true"></i>
                            <span x-show="!submitting">{{ __('Envoyer le message') }}</span>
                            <span x-show="submitting">{{ __('Envoi en cours...') }}</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
