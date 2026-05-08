<?php

use App\Models\Article;
use App\Services\SlugService;

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

it('returns expected slug for a simple title', function () {
    $service = app(SlugService::class);

    $slug = $service->makeUnique(Article::class, 'Mon titre');

    expect($slug)->toBe('mon-titre');
});

it('returns incremented slug when same title already exists', function () {
    $service = app(SlugService::class);

    $first = $service->makeUnique(Article::class, 'Mon titre');
    Article::create([
        'titre' => 'Mon titre',
        'slug' => $first,
        'contenu' => 'Contenu',
        'auteur' => 'Auteur',
        'categorie' => 'Catégorie',
        'statut' => 'publie',
    ]);

    $second = $service->makeUnique(Article::class, 'Mon titre');

    expect($first)->toBe('mon-titre');
    expect($second)->toBe('mon-titre-1');
});

it('respects exceptId when updating an existing record', function () {
    $service = app(SlugService::class);

    $article = Article::create([
        'titre' => 'Titre courant',
        'slug' => 'titre-courant',
        'contenu' => 'Contenu',
        'auteur' => 'Auteur',
        'categorie' => 'Catégorie',
        'statut' => 'publie',
    ]);

    $slug = $service->makeUnique(Article::class, 'Titre courant', $article->id);

    expect($slug)->toBe('titre-courant');
});

it('normalizes accents and special characters correctly', function () {
    $service = app(SlugService::class);

    $slug = $service->makeUnique(Article::class, 'Économie & Développement 2026 !');

    expect($slug)->toBe('economie-developpement-2026');
});
