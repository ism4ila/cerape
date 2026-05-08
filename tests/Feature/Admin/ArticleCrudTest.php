<?php

use App\Models\Article;
use App\Models\User;

function articlePayload(array $overrides = []): array
{
    return array_merge([
        'titre' => 'Titre article test',
        'contenu' => 'Contenu de test',
        'auteur' => 'Auteur test',
        'categorie' => 'Catégorie test',
        'statut' => 'publie',
        'tags' => 'tag1, tag2',
    ], $overrides);
}

it('allows admin to create an article', function () {
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)
        ->post(route('admin.articles.store'), articlePayload())
        ->assertRedirect(route('admin.articles.index'))
        ->assertSessionHas('success');

    $this->assertDatabaseHas('articles', [
        'titre' => 'Titre article test',
        'auteur' => 'Auteur test',
    ]);
});

it('fails validation when title is empty', function () {
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)
        ->from(route('admin.articles.create'))
        ->post(route('admin.articles.store'), articlePayload(['titre' => '']))
        ->assertRedirect(route('admin.articles.create'))
        ->assertSessionHasErrors('titre');
});

it('generates slug automatically from title', function () {
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)->post(route('admin.articles.store'), articlePayload([
        'titre' => 'Mon Super Titre',
    ]));

    $this->assertDatabaseHas('articles', [
        'titre' => 'Mon Super Titre',
        'slug' => 'mon-super-titre',
    ]);
});

it('generates unique slugs for duplicate titles', function () {
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)->post(route('admin.articles.store'), articlePayload([
        'titre' => 'Même titre',
    ]));

    $this->actingAs($admin)->post(route('admin.articles.store'), articlePayload([
        'titre' => 'Même titre',
        'auteur' => 'Autre auteur',
    ]));

    $slugs = Article::query()->where('titre', 'Même titre')->pluck('slug')->all();

    expect($slugs)->toContain('meme-titre');
    expect($slugs)->toContain('meme-titre-1');
});

it('allows admin to update an existing article', function () {
    $admin = User::factory()->admin()->create();
    $article = Article::create([
        'titre' => 'Titre initial',
        'slug' => 'titre-initial',
        'contenu' => 'Contenu initial',
        'auteur' => 'Auteur',
        'categorie' => 'Catégorie',
        'statut' => 'brouillon',
    ]);

    $this->actingAs($admin)
        ->put(route('admin.articles.update', $article), articlePayload([
            'titre' => 'Titre modifié',
            'contenu' => 'Contenu modifié',
            'auteur' => 'Auteur modifié',
            'categorie' => 'Catégorie modifiée',
            'statut' => 'publie',
        ]))
        ->assertRedirect(route('admin.articles.index'));

    $this->assertDatabaseHas('articles', [
        'id' => $article->id,
        'titre' => 'Titre modifié',
        'slug' => 'titre-modifie',
    ]);
});

it('allows superadmin to delete an article', function () {
    $superadmin = User::factory()->superadmin()->create();
    $article = Article::create([
        'titre' => 'Supprimable',
        'slug' => 'supprimable',
        'contenu' => 'Contenu',
        'auteur' => 'Auteur',
        'categorie' => 'Catégorie',
        'statut' => 'publie',
    ]);

    $this->actingAs($superadmin)
        ->delete(route('admin.articles.destroy', $article))
        ->assertRedirect(route('admin.articles.index'));

    $this->assertDatabaseMissing('articles', ['id' => $article->id]);
});

it('forbids editeur from deleting an article', function () {
    $editeur = User::factory()->editeur()->create();
    $article = Article::create([
        'titre' => 'Non supprimable',
        'slug' => 'non-supprimable',
        'contenu' => 'Contenu',
        'auteur' => 'Auteur',
        'categorie' => 'Catégorie',
        'statut' => 'publie',
    ]);

    $this->actingAs($editeur)
        ->delete(route('admin.articles.destroy', $article))
        ->assertForbidden();
});
