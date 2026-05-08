@extends('layouts.admin')

@section('header', 'Nouvel Événement')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4 p-md-5">
                <form action="{{ route('admin.events.store') }}" method="POST" x-data="{ submitting: false }" @submit="submitting = true">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="titre" class="form-label fw-bold">Titre de l'événement <span class="text-danger">*</span></label>
                        <input type="text" class="form-control bg-light border-0 py-2 @error('titre') is-invalid @enderror" id="titre" name="titre" value="{{ old('titre') }}" required aria-required="true">
                        @error('titre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="type" class="form-label fw-bold">Type d'événement <span class="text-danger">*</span></label>
                            <select class="form-select bg-light border-0 py-2 @error('type') is-invalid @enderror" id="type" name="type" required aria-required="true">
                                <option value="" disabled selected>Sélectionner...</option>
                                <option value="formation" {{ old('type') == 'formation' ? 'selected' : '' }}>Formation</option>
                                <option value="sensibilisation" {{ old('type') == 'sensibilisation' ? 'selected' : '' }}>Sensibilisation</option>
                                <option value="ag" {{ old('type') == 'ag' ? 'selected' : '' }}>Assemblée Générale</option>
                                <option value="commemoration" {{ old('type') == 'commemoration' ? 'selected' : '' }}>Commémoration</option>
                                <option value="autre" {{ old('type') == 'autre' ? 'selected' : '' }}>Autre</option>
                            </select>
                            @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="date_heure" class="form-label fw-bold">Date et Heure <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control bg-light border-0 py-2 @error('date_heure') is-invalid @enderror" id="date_heure" name="date_heure" value="{{ old('date_heure') }}" required aria-required="true">
                            @error('date_heure') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-8">
                            <label for="lieu" class="form-label fw-bold">Lieu <span class="text-danger">*</span></label>
                            <input type="text" class="form-control bg-light border-0 py-2 @error('lieu') is-invalid @enderror" id="lieu" name="lieu" value="{{ old('lieu') }}" placeholder="Ex: Siège du CERAPE, Mandjou" required aria-required="true">
                            @error('lieu') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="capacite_max" class="form-label fw-bold">Capacité Max (0 = illimité)</label>
                            <input type="number" class="form-control bg-light border-0 py-2 @error('capacite_max') is-invalid @enderror" id="capacite_max" name="capacite_max" value="{{ old('capacite_max', 0) }}" min="0" required>
                            @error('capacite_max') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="image_url" class="form-label fw-bold">URL de l'image (optionnel)</label>
                        <input type="url" class="form-control bg-light border-0 py-2 @error('image_url') is-invalid @enderror" id="image_url" name="image_url" value="{{ old('image_url') }}" placeholder="https://...">
                        @error('image_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label fw-bold">Description <span class="text-danger">*</span></label>
                        <textarea class="form-control bg-light border-0 py-2 @error('description') is-invalid @enderror" id="description" name="description" rows="5" required aria-required="true">{{ old('description') }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-5">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="inscriptions_ouvertes" name="inscriptions_ouvertes" value="1" {{ old('inscriptions_ouvertes', '1') == '1' ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold ms-2" for="inscriptions_ouvertes">Ouvrir les inscriptions en ligne</label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-4 border-top">
                        <a href="{{ route('admin.events.index') }}" class="btn btn-light rounded-pill px-4">Annuler</a>
                        <button type="submit" class="btn btn-info text-white rounded-pill px-5 fw-bold shadow-sm" :disabled="submitting">Créer l'événement</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
