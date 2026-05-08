<?php

use App\Models\Article;
use App\Models\User;

it('public pages render images with alt attributes', function () {
    $response = $this->get(route('home'));
    $response->assertOk();

    preg_match_all('/<img\b[^>]*>/i', $response->getContent(), $matches);
    expect($matches[0])->not->toBeEmpty();

    foreach ($matches[0] as $imgTag) {
        expect($imgTag)->toContain('alt=');
    }
});

it('public layout contains skip link', function () {
    $this->get(route('home'))
        ->assertOk()
        ->assertSee('Aller au contenu');
});

it('admin delete action exposes aria labels on icon buttons', function () {
    $admin = User::factory()->admin()->create();
    Article::create([
        'titre' => 'Accessibilite admin',
        'slug' => 'accessibilite-admin',
        'contenu' => 'Contenu',
        'auteur' => 'Auteur',
        'categorie' => 'Catégorie',
        'statut' => 'publie',
    ]);

    $this->actingAs($admin)
        ->get(route('admin.articles.index'))
        ->assertOk()
        ->assertSee('aria-label="Voir l\'article"', false)
        ->assertSee('aria-label="Modifier l\'article"', false);
});

it('validation errors include role alert in auth pages', function () {
    $this->followingRedirects()
        ->from(route('login'))
        ->post(route('login'), [
            'email' => 'invalid-email',
            'password' => '',
        ])
        ->assertOk()
        ->assertSee('role="alert"', false);
});
