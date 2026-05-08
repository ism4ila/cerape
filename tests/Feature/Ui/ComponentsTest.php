<?php

use App\Models\Article;
use App\Models\User;

it('home page contains an h1 tag', function () {
    $this->get(route('home'))
        ->assertOk()
        ->assertSee('<h1', false);
});

it('navigation contains expected links', function () {
    $response = $this->get(route('home'));

    $response->assertOk();
    $response->assertSee(route('home'), false);
    $response->assertSee(route('about'), false);
    $response->assertSee(route('articles.index'), false);
    $response->assertSee(route('projets.index'), false);
    $response->assertSee(route('contact'), false);
    $response->assertSee(route('don'), false);
});

it('empty list page displays empty-state component', function () {
    $this->get(route('events.index'))
        ->assertOk()
        ->assertSee('Aucun evenement a venir');
});

it('form pages expose labels and matching input ids', function () {
    $this->get(route('contact'))
        ->assertOk()
        ->assertSee('for="nom"', false)
        ->assertSee('id="nom"', false)
        ->assertSee('for="email"', false)
        ->assertSee('id="email"', false);

    $this->get(route('login'))
        ->assertOk()
        ->assertSee('for="email"', false)
        ->assertSee('id="email"', false)
        ->assertSee('for="password"', false)
        ->assertSee('id="password"', false);
});

it('flash messages are displayed after crud action', function () {
    $admin = User::factory()->superadmin()->create();

    $this->actingAs($admin)->post(route('admin.articles.store'), [
        'titre' => 'Flash article',
        'contenu' => 'Contenu',
        'auteur' => 'Auteur',
        'categorie' => 'Catégorie',
        'statut' => 'publie',
    ])->assertRedirect(route('admin.articles.index'));

    $article = Article::query()->where('titre', 'Flash article')->firstOrFail();

    $this->actingAs($admin)
        ->followingRedirects()
        ->delete(route('admin.articles.destroy', $article))
        ->assertSee('Article supprimé avec succès.');
});
