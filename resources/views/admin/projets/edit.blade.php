@extends('layouts.admin')

@section('header', 'Modifier le Projet')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4 p-md-5">
                <form action="{{ route('admin.projets.update', $projet->id) }}" method="POST" x-data="{ submitting: false }" @submit="submitting = true">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-4 mb-4">
                        <div class="col-md-8">
                            <label for="titre" class="form-label fw-bold">Intitulé du projet <span class="text-danger">*</span></label>
                            <input type="text" class="form-control bg-light border-0 py-2 @error('titre') is-invalid @enderror" id="titre" name="titre" value="{{ old('titre', $projet->titre) }}" required aria-required="true">
                            @error('titre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="domaine_id" class="form-label fw-bold">Domaine <span class="text-danger">*</span></label>
                            <select class="form-select bg-light border-0 py-2 @error('domaine_id') is-invalid @enderror" id="domaine_id" name="domaine_id" required aria-required="true">
                                @foreach($domaines as $domaine)
                                    <option value="{{ $domaine->id }}" {{ (string) old('domaine_id', $projet->domaine_id) === (string) $domaine->id ? 'selected' : '' }}>
                                        {{ $domaine->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('domaine_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label for="lieu" class="form-label fw-bold">Localisation / Lieu <span class="text-danger">*</span></label>
                            <input type="text" class="form-control bg-light border-0 py-2 @error('lieu') is-invalid @enderror" id="lieu" name="lieu" value="{{ old('lieu', $projet->lieu) }}" required aria-required="true">
                            @error('lieu') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="beneficiaires" class="form-label fw-bold">Nombre de bénéficiaires <span class="text-danger">*</span></label>
                            <input type="number" class="form-control bg-light border-0 py-2 @error('beneficiaires') is-invalid @enderror" id="beneficiaires" name="beneficiaires" value="{{ old('beneficiaires', $projet->beneficiaires) }}" required aria-required="true">
                            @error('beneficiaires') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label for="date_debut" class="form-label fw-bold">Date de début</label>
                            <input type="date" class="form-control bg-light border-0 py-2 @error('date_debut') is-invalid @enderror" id="date_debut" name="date_debut" value="{{ old('date_debut', $projet->date_debut ? $projet->date_debut->format('Y-m-d') : '') }}">
                        </div>
                        <div class="col-md-6">
                            <label for="date_fin" class="form-label fw-bold">Date de fin</label>
                            <input type="date" class="form-control bg-light border-0 py-2 @error('date_fin') is-invalid @enderror" id="date_fin" name="date_fin" value="{{ old('date_fin', $projet->date_fin ? $projet->date_fin->format('Y-m-d') : '') }}">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label fw-bold">Description détaillée <span class="text-danger">*</span></label>
                        <textarea class="form-control bg-light border-0 py-2 @error('description') is-invalid @enderror" id="description" name="description" rows="6" required aria-required="true">{{ old('description', $projet->description) }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row g-4 mb-5">
                        <div class="col-md-6">
                            <label for="statut" class="form-label fw-bold">Statut du projet <span class="text-danger">*</span></label>
                            <select class="form-select bg-light border-0 py-2 @error('statut') is-invalid @enderror" id="statut" name="statut" required aria-required="true">
                                <option value="planifie" {{ old('statut', $projet->statut) == 'planifie' ? 'selected' : '' }}>Planifié</option>
                                <option value="en_cours" {{ old('statut', $projet->statut) == 'en_cours' ? 'selected' : '' }}>En cours</option>
                                <option value="termine" {{ old('statut', $projet->statut) == 'termine' ? 'selected' : '' }}>Terminé</option>
                            </select>
                        </div>
                        <div class="col-md-6 d-flex align-items-end pb-2">
                            <div class="form-check form-switch p-0 ms-4">
                                <input class="form-check-input" type="checkbox" role="switch" id="visible_public" name="visible_public" value="1" {{ old('visible_public', $projet->visible_public) ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold ms-2" for="visible_public">Visible sur le site public</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-4 border-top">
                        <a href="{{ route('admin.projets.index') }}" class="btn btn-light rounded-pill px-4">Annuler</a>
                        <button type="submit" class="btn btn-success rounded-pill px-5 fw-bold shadow-sm" :disabled="submitting">Enregistrer les modifications</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
