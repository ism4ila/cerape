@extends('layouts.public')

@section('title', __('Erreur serveur'))

@section('content')
<section class="py-5 bg-light min-vh-100 d-flex align-items-center">
    <div class="container text-center">
        <h1 class="display-4 fw-bold mb-3">{{ __('500') }}</h1>
        <p class="lead text-secondary mb-4">{{ __('Une erreur interne est survenue. Veuillez réessayer plus tard.') }}</p>
        <a href="{{ route('home') }}" class="btn btn-cer-primary rounded-pill px-4">
            {{ __('Retour à l\'accueil') }}
        </a>
    </div>
</section>
@endsection
