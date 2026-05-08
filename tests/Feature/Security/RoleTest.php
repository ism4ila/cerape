<?php

use App\Models\Article;
use App\Models\Domaine;
use App\Models\Projet;
use App\Models\User;

it('redirects guest to login on admin routes', function () {
    $this->get(route('admin.dashboard'))->assertRedirect(route('login'));
    $this->get(route('admin.articles.index'))->assertRedirect(route('login'));
    $this->get(route('admin.projets.index'))->assertRedirect(route('login'));
});

it('redirects member away from admin routes with error message', function () {
    $member = User::factory()->member()->create();

    $this->actingAs($member)
        ->get(route('admin.dashboard'))
        ->assertRedirect(route('dashboard'))
        ->assertSessionHas('error');
});

it('allows editeur to create and edit but not delete articles', function () {
    $editeur = User::factory()->editeur()->create();
    $article = Article::create([
        'titre' => 'Test Role Editeur',
        'slug' => 'test-role-editeur',
        'contenu' => 'Contenu',
        'auteur' => 'Auteur',
        'categorie' => 'Catégorie',
        'statut' => 'publie',
        'date_publication' => now(),
    ]);

    $this->actingAs($editeur)->get(route('admin.articles.create'))->assertOk();
    $this->actingAs($editeur)->get(route('admin.articles.edit', $article))->assertOk();
    $this->actingAs($editeur)->delete(route('admin.articles.destroy', $article))->assertForbidden();
});

it('allows admin access but forbids destructive action reserved to superadmin', function () {
    $admin = User::factory()->admin()->create();
    $article = Article::create([
        'titre' => 'Test Role Admin',
        'slug' => 'test-role-admin',
        'contenu' => 'Contenu',
        'auteur' => 'Auteur',
        'categorie' => 'Catégorie',
        'statut' => 'publie',
        'date_publication' => now(),
    ]);

    $this->actingAs($admin)->get(route('admin.dashboard'))->assertOk();
    $this->actingAs($admin)->delete(route('admin.articles.destroy', $article))->assertForbidden();
});

it('allows superadmin full access including delete', function () {
    $superadmin = User::factory()->superadmin()->create();
    $domaine = Domaine::create([
        'nom' => 'Domaine Test',
        'slug' => 'domaine-test',
        'description' => 'Description',
        'icone' => null,
    ]);
    $projet = Projet::create([
        'titre' => 'Projet superadmin',
        'slug' => 'projet-superadmin',
        'domaine_id' => $domaine->id,
        'description' => 'Description',
        'lieu' => 'Lieu',
        'beneficiaires' => 100,
        'statut' => 'en_cours',
        'visible_public' => true,
    ]);

    $this->actingAs($superadmin)->get(route('admin.dashboard'))->assertOk();
    $this->actingAs($superadmin)->delete(route('admin.projets.destroy', $projet))->assertRedirect(route('admin.projets.index'));
});
