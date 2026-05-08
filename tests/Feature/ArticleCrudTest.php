<?php

use App\Models\Article;
use App\Models\User;

it('allows admin to create an article', function () {
    $admin = User::factory()->admin()->create();

    $payload = [
        'titre' => 'Nouvel article test',
        'contenu' => '<p>Contenu test</p>',
        'auteur' => 'Admin Test',
        'categorie' => 'Actualité',
        'image_url' => 'https://example.com/image.jpg',
        'tags' => 'test,laravel',
        'statut' => 'publie',
        'date_publication' => now()->toDateTimeString(),
    ];

    $this->actingAs($admin)
        ->post(route('admin.articles.store'), $payload)
        ->assertRedirect(route('admin.articles.index'));

    $this->assertDatabaseHas('articles', [
        'titre' => 'Nouvel article test',
        'auteur' => 'Admin Test',
    ]);
});

it('forbids editeur from deleting an article', function () {
    $editeur = User::factory()->editeur()->create();
    $article = Article::create([
        'titre' => 'Article existant',
        'slug' => 'article-existant',
        'contenu' => '<p>Contenu</p>',
        'auteur' => 'Auteur',
        'categorie' => 'Test',
        'statut' => 'publie',
    ]);

    $this->actingAs($editeur)
        ->delete(route('admin.articles.destroy', $article))
        ->assertForbidden();
});
