@extends('layouts.public')

@section('title', 'Questions Fréquentes (FAQ)')

@section('content')
<div class="bg-cer-blue text-white py-5">
    <div class="container text-center">
        <h1 class="display-4 fw-bold">Questions Fréquentes</h1>
        <p class="lead opacity-75">Trouvez rapidement des réponses à vos questions sur le CERAPE.</p>
    </div>
</div>

<div class="py-5 bg-light min-vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                @if($faqs->count() > 0)
                    <div class="accordion accordion-flush bg-white rounded-4 shadow-sm p-4" id="faqAccordion">
                        @foreach($faqs as $index => $faq)
                            <div class="accordion-item border-0 mb-3 bg-light rounded-3">
                                <h2 class="accordion-header" id="heading{{ $index }}">
                                    <button class="accordion-button collapsed bg-transparent fw-bold fs-5 shadow-none rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="false" aria-controls="collapse{{ $index }}">
                                        {{ $faq->question }}
                                    </button>
                                </h2>
                                <div id="collapse{{ $index }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $index }}" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body text-secondary lh-lg pt-0">
                                        {{-- Approved raw HTML context: newline formatting is generated from escaped FAQ answer text. --}}
                                        {!! nl2br(e($faq->reponse)) !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <p class="text-muted fs-5">Aucune question n'a été ajoutée pour le moment.</p>
                    </div>
                @endif
                
                <div class="text-center mt-5">
                    <p class="fs-5 text-dark">Vous n'avez pas trouvé votre réponse ?</p>
                    <a href="{{ route('contact') }}" class="btn btn-cer-primary btn-lg rounded-pill px-5 mt-3">Contactez-nous</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .accordion-button:not(.collapsed) {
        color: var(--cer-blue);
        background-color: transparent;
        box-shadow: none;
    }
    .accordion-button:focus {
        border-color: transparent;
        box-shadow: none;
    }
</style>
@endsection
