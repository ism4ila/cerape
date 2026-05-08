<?php

use App\Models\Article;
use App\Models\User;

beforeEach(function (): void {
    if (! class_exists('Purify')) {
        test()->markTestSkipped('mews/purifier package is not installed.');
    }
});

it('renders malicious html without executing script tags', function () {
    $article = Article::create([
        'titre' => 'Article XSS',
        'slug' => 'article-xss',
        'contenu' => '<p>Contenu sûr</p><script>alert("xss")</script>',
        'auteur' => 'Auteur',
        'categorie' => 'Sécurité',
        'statut' => 'publie',
        'date_publication' => now(),
    ]);

    $response = $this->get(route('articles.show', $article->slug));

    $response->assertOk();
    $response->assertDontSee('<script>alert("xss")</script>', false);
    $response->assertSee('Contenu sûr');
});

it('purifies dangerous attributes from article content', function () {
    $article = Article::create([
        'titre' => 'Article XSS Attribut',
        'slug' => 'article-xss-attribut',
        'contenu' => '<img src="x" onerror="alert(1)"><a href="javascript:alert(1)">lien</a>',
        'auteur' => 'Auteur',
        'categorie' => 'Sécurité',
        'statut' => 'publie',
        'date_publication' => now(),
    ]);

    $response = $this->get(route('articles.show', $article->slug));

    $response->assertOk();
    $response->assertDontSee('onerror=', false);
    $response->assertDontSee('javascript:alert', false);
});

it('prevents editeur from creating script tag content in admin article form', function () {
    $editeur = User::factory()->editeur()->create();

    $payload = [
        'titre' => 'Injection Script',
        'contenu' => '<p>ok</p><script>alert(9)</script>',
        'auteur' => 'Editeur',
        'categorie' => 'Sécurité',
        'statut' => 'publie',
    ];

    $this->actingAs($editeur)
        ->post(route('admin.articles.store'), $payload)
        ->assertRedirect(route('admin.articles.index'));

    $created = Article::query()->where('titre', 'Injection Script')->firstOrFail();
    $response = $this->get(route('articles.show', $created->slug));
    $response->assertDontSee('<script>alert(9)</script>', false);
});
