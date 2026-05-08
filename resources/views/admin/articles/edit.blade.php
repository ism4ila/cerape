@extends('layouts.admin')

@section('header', 'Modifier l\'Article')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4 p-md-5">
                <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" x-data="{ submitting: false }" @submit="submitting = true">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label for="titre" class="form-label fw-bold">Titre de l'article <span class="text-danger">*</span></label>
                        <input type="text" class="form-control bg-light border-0 py-2 @error('titre') is-invalid @enderror" id="titre" name="titre" value="{{ old('titre', $article->titre) }}" required aria-required="true">
                        @error('titre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="auteur" class="form-label fw-bold">Auteur <span class="text-danger">*</span></label>
                            <input type="text" class="form-control bg-light border-0 py-2 @error('auteur') is-invalid @enderror" id="auteur" name="auteur" value="{{ old('auteur', $article->auteur) }}" required aria-required="true">
                            @error('auteur') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="categorie" class="form-label fw-bold">Catégorie <span class="text-danger">*</span></label>
                            <select class="form-select bg-light border-0 py-2 @error('categorie') is-invalid @enderror" id="categorie" name="categorie" required aria-required="true">
                                <option value="Éducation" {{ old('categorie', $article->categorie) == 'Éducation' ? 'selected' : '' }}>Éducation</option>
                                <option value="Santé" {{ old('categorie', $article->categorie) == 'Santé' ? 'selected' : '' }}>Santé</option>
                                <option value="Environnement" {{ old('categorie', $article->categorie) == 'Environnement' ? 'selected' : '' }}>Environnement</option>
                                <option value="Formation" {{ old('categorie', $article->categorie) == 'Formation' ? 'selected' : '' }}>Formation</option>
                                <option value="Partenariat" {{ old('categorie', $article->categorie) == 'Partenariat' ? 'selected' : '' }}>Partenariat</option>
                            </select>
                            @error('categorie') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="image_url" class="form-label fw-bold">URL de l'image</label>
                        <input type="url" class="form-control bg-light border-0 py-2 @error('image_url') is-invalid @enderror" id="image_url" name="image_url" value="{{ old('image_url', $article->image_url) }}">
                        @error('image_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="contenu" class="form-label fw-bold">Contenu <span class="text-danger">*</span></label>
                        <textarea class="form-control bg-light border-0 py-2 @error('contenu') is-invalid @enderror" id="contenu" name="contenu" rows="10" required aria-required="true">{{ old('contenu', $article->contenu) }}</textarea>
                        @error('contenu') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="tags" class="form-label fw-bold">Tags (séparés par des virgules)</label>
                        <input type="text" class="form-control bg-light border-0 py-2 @error('tags') is-invalid @enderror" id="tags" name="tags" value="{{ old('tags', is_array($article->tags) ? implode(', ', $article->tags) : '') }}">
                    </div>

                    <div class="mb-5">
                        <label for="statut" class="form-label fw-bold">Statut de publication <span class="text-danger">*</span></label>
                        <div class="d-flex gap-4 mt-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="statut" id="brouillon" value="brouillon" {{ old('statut', $article->statut) == 'brouillon' ? 'checked' : '' }}>
                                <label class="form-check-label" for="brouillon">Brouillon</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="statut" id="publie" value="publie" {{ old('statut', $article->statut) == 'publie' ? 'checked' : '' }}>
                                <label class="form-check-label text-success fw-bold" for="publie">Publié</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="statut" id="archive" value="archive" {{ old('statut', $article->statut) == 'archive' ? 'checked' : '' }}>
                                <label class="form-check-label text-secondary" for="archive">Archivé</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-4 border-top">
                        <a href="{{ route('admin.articles.index') }}" class="btn btn-light rounded-pill px-4">Annuler</a>
                        <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold shadow-sm" :disabled="submitting">Mettre à jour</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
