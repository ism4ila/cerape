@extends('layouts.public')

@section('title', __('Connexion - Espace membre'))

@section('content')
<section class="bg-gray-50 px-6 py-14 lg:px-16">
    <div class="mx-auto max-w-md">
        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white">
            <div class="border-b border-gray-200 bg-[--cerape-orange-light] px-6 py-5 text-center">
                <h1 class="text-2xl font-medium text-gray-900">{{ __('Connexion') }}</h1>
                <p class="mt-1 text-sm text-gray-500">{{ __('Accédez à votre espace CERAPE') }}</p>
            </div>
            <div class="p-6">
                @if (session('status'))
                    <div class="mb-4 rounded-xl border border-[--cerape-green] bg-[--cerape-green-light] px-4 py-3 text-sm text-[--cerape-green]" role="status">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" x-data="{ submitting: false }" @submit="submitting = true" class="space-y-4">
                    @csrf

                    <div>
                        <label for="email" class="mb-1 block text-xs text-gray-500">{{ __('Adresse email') }}</label>
                        <div class="relative">
                            <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-gray-400">
                                <i class="fa-regular fa-envelope" aria-hidden="true"></i>
                            </span>
                            <input id="email" type="email" class="w-full rounded-xl border border-gray-200 py-2.5 pl-10 pr-3 text-sm outline-none focus:border-[--cerape-orange] focus:ring-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required aria-required="true" autofocus autocomplete="username" aria-describedby="email-error" aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}">
                        </div>
                        @error('email')
                            <p id="email-error" class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <div class="mb-1 flex items-center justify-between">
                            <label for="password" class="block text-xs text-gray-500">{{ __('Mot de passe') }}</label>
                            @if (Route::has('password.request'))
                                <a class="text-xs text-[--cerape-orange] hover:underline" href="{{ route('password.request') }}">
                                    {{ __('Mot de passe oublié ?') }}
                                </a>
                            @endif
                        </div>
                        <div class="relative">
                            <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-gray-400">
                                <i class="fa-solid fa-lock" aria-hidden="true"></i>
                            </span>
                            <input id="password" type="password" class="w-full rounded-xl border border-gray-200 py-2.5 pl-10 pr-3 text-sm outline-none focus:border-[--cerape-orange] focus:ring-0 @error('password') is-invalid @enderror" name="password" required aria-required="true" autocomplete="current-password" aria-describedby="password-error" aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}">
                        </div>
                        @error('password')
                            <p id="password-error" class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    <label for="remember_me" class="flex items-center gap-2 text-xs text-gray-600">
                        <input type="checkbox" class="rounded border-gray-300 text-[--cerape-orange] focus:ring-[--cerape-orange]" id="remember_me" name="remember">
                        <span>{{ __('Se souvenir de moi') }}</span>
                    </label>

                    <button type="submit" class="inline-flex w-full items-center justify-center rounded-full bg-[--cerape-orange] px-4 py-2.5 text-sm text-white hover:opacity-90" :disabled="submitting">
                        <span x-show="!submitting">{{ __('Se connecter') }}</span>
                        <span x-show="submitting">{{ __('Connexion...') }}</span>
                    </button>

                    <div class="pt-1 text-center">
                        <p class="text-xs text-gray-500">{{ __('Pas encore de compte ?') }}</p>
                        <a href="{{ route('register') }}" class="text-sm text-[--cerape-orange] hover:underline">
                            {{ __('Créer un compte membre') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="mt-4 text-center">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-xs text-gray-500 hover:text-[--cerape-orange]">
                <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>{{ __('Retour à l\'accueil') }}
            </a>
        </div>
    </div>
</section>
@endsection
