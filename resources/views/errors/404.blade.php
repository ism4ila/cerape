@extends('layouts.public')

@section('title', __('Page non trouvée'))

@section('content')
<section class="py-5 bg-light min-vh-100 d-flex align-items-center">
    <div class="container text-center">
        <h1 class="display-4 fw-bold mb-3">{{ __('404') }}</h1>
        <p class="lead text-secondary mb-4">{{ __('La page demandée est introuvable.') }}</p>
        <a href="{{ route('home') }}" class="btn btn-cer-primary rounded-pill px-4">
            {{ __('Retour à l\'accueil') }}
        </a>
    </div>
</section>
@endsection
