@extends('layouts.public')

@section('title', 'Faire un don')

@section('content')
<div class="bg-cer-blue text-white py-5">
    <div class="container text-center">
        <h1 class="display-4 fw-bold">Faites un don</h1>
        <p class="lead opacity-75">Votre générosité permet de financer nos projets et de changer des vies.</p>
    </div>
</div>

<div class="py-5 bg-light">
    <div class="container">
        <x-breadcrumb :items="[
            ['label' => 'Accueil', 'url' => route('home')],
            ['label' => 'Faire un don'],
        ]" />
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-body p-4 p-md-5">
                        
                        <form action="{{ route('don.store') }}" method="POST" x-data="{ submitting: false }" @submit="submitting = true" data-don-form>
                            @csrf
                            
                            <!-- Step 1: Amount -->
                            <h4 class="fw-bold mb-4 border-bottom pb-2">1. Choisissez votre montant (FCFA)</h4>
                            <div class="row g-3 mb-5" id="amount-selector">
                                <div class="col-6 col-md-3">
                                    <input type="radio" class="btn-check" name="montant" id="btn-500" value="500" autocomplete="off" {{ old('montant') == '500' ? 'checked' : '' }}>
                                    <label class="btn btn-outline-primary w-100 py-3 fw-bold fs-5 rounded-3" for="btn-500">500</label>
                                </div>
                                <div class="col-6 col-md-3">
                                    <input type="radio" class="btn-check" name="montant" id="btn-1000" value="1000" autocomplete="off" {{ old('montant', '1000') == '1000' ? 'checked' : '' }}>
                                    <label class="btn btn-outline-primary w-100 py-3 fw-bold fs-5 rounded-3" for="btn-1000">1 000</label>
                                </div>
                                <div class="col-6 col-md-3">
                                    <input type="radio" class="btn-check" name="montant" id="btn-2500" value="2500" autocomplete="off" {{ old('montant') == '2500' ? 'checked' : '' }}>
                                    <label class="btn btn-outline-primary w-100 py-3 fw-bold fs-5 rounded-3" for="btn-2500">2 500</label>
                                </div>
                                <div class="col-6 col-md-3">
                                    <input type="radio" class="btn-check" name="montant" id="btn-5000" value="5000" autocomplete="off" {{ old('montant') == '5000' ? 'checked' : '' }}>
                                    <label class="btn btn-outline-primary w-100 py-3 fw-bold fs-5 rounded-3" for="btn-5000">5 000</label>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0">Autre montant</span>
                                    <input type="number" class="form-control bg-light border-0 py-3 fs-5" id="customAmount" placeholder="Ex: 10000" aria-label="Montant personnalisé" data-custom-amount>
                                        <span class="input-group-text bg-light border-0 fw-bold">FCFA</span>
                                    </div>
                                    <input type="hidden" name="montant_custom" id="hiddenCustomAmount" data-hidden-custom-amount>
                                </div>
                                @error('montant') <p id="montant-error" class="text-danger small mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Step 2: Information -->
                            <h4 class="fw-bold mb-4 border-bottom pb-2">2. Vos informations</h4>
                            <div class="row g-3 mb-5">
                                <div class="col-md-6">
                                    <label for="donateur" class="form-label fw-semibold">Prénom & Nom <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control bg-light border-0 py-2 @error('donateur') is-invalid @enderror" id="donateur" name="donateur" value="{{ old('donateur') }}" required aria-required="true" aria-describedby="donateur-error" aria-invalid="{{ $errors->has('donateur') ? 'true' : 'false' }}">
                                    @error('donateur') <p id="donateur-error" class="invalid-feedback">{{ $message }}</p> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control bg-light border-0 py-2 @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required aria-required="true" aria-describedby="email-error" aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}">
                                    @error('email') <p id="email-error" class="invalid-feedback">{{ $message }}</p> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="telephone" class="form-label fw-semibold">Téléphone (Optionnel)</label>
                                    <input type="tel" class="form-control bg-light border-0 py-2 @error('telephone') is-invalid @enderror" id="telephone" name="telephone" value="{{ old('telephone') }}" pattern="[+0-9\s\-]{7,15}" aria-describedby="telephone-error" aria-invalid="{{ $errors->has('telephone') ? 'true' : 'false' }}">
                                    @error('telephone') <p id="telephone-error" class="invalid-feedback">{{ $message }}</p> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="cause" class="form-label fw-semibold">Domaine à soutenir <span class="text-danger">*</span></label>
                                    <select class="form-select bg-light border-0 py-2 @error('cause') is-invalid @enderror" id="cause" name="cause" required aria-required="true" aria-describedby="cause-error" aria-invalid="{{ $errors->has('cause') ? 'true' : 'false' }}">
                                        <option value="Non spécifié" {{ old('cause', request('cause')) == 'Non spécifié' ? 'selected' : '' }}>Là où les besoins sont les plus urgents</option>
                                        <option value="Éducation" {{ old('cause', request('cause')) == 'Éducation' ? 'selected' : '' }}>Éducation et bourses</option>
                                        <option value="Santé" {{ old('cause', request('cause')) == 'Santé' ? 'selected' : '' }}>Santé rurale</option>
                                        <option value="Environnement" {{ old('cause', request('cause')) == 'Environnement' ? 'selected' : '' }}>Protection de l'environnement</option>
                                    </select>
                                    @error('cause') <p id="cause-error" class="invalid-feedback">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <!-- Step 3: Payment -->
                            <h4 class="fw-bold mb-4 border-bottom pb-2">3. Mode de paiement</h4>
                            <div class="row g-3 mb-5">
                                <div class="col-12">
                                    <select class="form-select bg-light border-0 py-3 fs-5 fw-semibold @error('moyen') is-invalid @enderror" id="moyen" name="moyen" required aria-required="true" aria-describedby="moyen-error" aria-invalid="{{ $errors->has('moyen') ? 'true' : 'false' }}">
                                        <option value="" disabled selected>Sélectionnez un mode de paiement</option>
                                        <option value="mtn" {{ old('moyen') == 'mtn' ? 'selected' : '' }}>Mobile Money (MTN)</option>
                                        <option value="orange" {{ old('moyen') == 'orange' ? 'selected' : '' }}>Orange Money</option>
                                        <option value="cinetpay" {{ old('moyen') == 'cinetpay' ? 'selected' : '' }}>Carte Bancaire (CinetPay)</option>
                                        <option value="paypal" {{ old('moyen') == 'paypal' ? 'selected' : '' }}>PayPal</option>
                                        <option value="virement" {{ old('moyen') == 'virement' ? 'selected' : '' }}>Virement Bancaire</option>
                                    </select>
                                    @error('moyen') <p id="moyen-error" class="invalid-feedback">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <!-- Submit -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-warning btn-lg rounded-pill px-5 py-3 fw-bold fs-4 shadow-sm w-100" :disabled="submitting">
                                    <span x-show="!submitting"><i class="fa-solid fa-lock me-2" aria-hidden="true"></i> Confirmer mon don</span>
                                    <span x-show="submitting">Traitement en cours...</span>
                                </button>
                                <p class="text-muted small mt-3"><i class="fa-solid fa-shield-halved me-1" aria-hidden="true"></i> Paiement 100% sécurisé</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
