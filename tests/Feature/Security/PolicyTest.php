<?php

use App\Models\Article;
use App\Models\Domaine;
use App\Models\Projet;
use App\Models\User;
use App\Policies\ArticlePolicy;
use App\Policies\ProjetPolicy;

it('checks ArticlePolicy abilities by role', function () {
    $policy = new ArticlePolicy();
    $article = Article::create([
        'titre' => 'Policy article',
        'slug' => 'policy-article',
        'contenu' => 'Contenu',
        'auteur' => 'Auteur',
        'categorie' => 'Catégorie',
        'statut' => 'publie',
        'date_publication' => now(),
    ]);

    $superadmin = User::factory()->superadmin()->create();
    $admin = User::factory()->admin()->create();
    $editeur = User::factory()->editeur()->create();
    $member = User::factory()->member()->create();

    expect($policy->viewAny($superadmin))->toBeTrue();
    expect($policy->create($superadmin))->toBeTrue();
    expect($policy->update($superadmin, $article))->toBeTrue();
    expect($policy->delete($superadmin, $article))->toBeTrue();

    expect($policy->viewAny($admin))->toBeTrue();
    expect($policy->create($admin))->toBeTrue();
    expect($policy->update($admin, $article))->toBeTrue();
    expect($policy->delete($admin, $article))->toBeFalse();

    expect($policy->viewAny($editeur))->toBeFalse();
    expect($policy->create($editeur))->toBeTrue();
    expect($policy->update($editeur, $article))->toBeTrue();
    expect($policy->delete($editeur, $article))->toBeFalse();

    expect($policy->viewAny($member))->toBeFalse();
    expect($policy->create($member))->toBeFalse();
    expect($policy->update($member, $article))->toBeFalse();
    expect($policy->delete($member, $article))->toBeFalse();
});

it('checks ProjetPolicy abilities by role', function () {
    $policy = new ProjetPolicy();
    $domaine = Domaine::create([
        'nom' => 'Policy domaine',
        'slug' => 'policy-domaine',
        'description' => 'Description',
        'icone' => null,
    ]);
    $projet = Projet::create([
        'titre' => 'Policy projet',
        'slug' => 'policy-projet',
        'domaine_id' => $domaine->id,
        'description' => 'Description',
        'lieu' => 'Lieu',
        'beneficiaires' => 10,
        'statut' => 'en_cours',
        'visible_public' => true,
    ]);

    $superadmin = User::factory()->superadmin()->create();
    $admin = User::factory()->admin()->create();
    $editeur = User::factory()->editeur()->create();
    $member = User::factory()->member()->create();

    expect($policy->viewAny($superadmin))->toBeTrue();
    expect($policy->create($superadmin))->toBeTrue();
    expect($policy->update($superadmin, $projet))->toBeTrue();
    expect($policy->delete($superadmin, $projet))->toBeTrue();

    expect($policy->viewAny($admin))->toBeTrue();
    expect($policy->create($admin))->toBeTrue();
    expect($policy->update($admin, $projet))->toBeTrue();
    expect($policy->delete($admin, $projet))->toBeFalse();

    expect($policy->viewAny($editeur))->toBeFalse();
    expect($policy->create($editeur))->toBeTrue();
    expect($policy->update($editeur, $projet))->toBeTrue();
    expect($policy->delete($editeur, $projet))->toBeFalse();

    expect($policy->viewAny($member))->toBeFalse();
    expect($policy->create($member))->toBeFalse();
    expect($policy->update($member, $projet))->toBeFalse();
    expect($policy->delete($member, $projet))->toBeFalse();
});

it('returns 403 when authorize blocks access', function () {
    $editeur = User::factory()->editeur()->create();
    $article = Article::create([
        'titre' => 'Policy delete blocked',
        'slug' => 'policy-delete-blocked',
        'contenu' => 'Contenu',
        'auteur' => 'Auteur',
        'categorie' => 'Catégorie',
        'statut' => 'publie',
        'date_publication' => now(),
    ]);

    $this->actingAs($editeur)
        ->delete(route('admin.articles.destroy', $article))
        ->assertForbidden();
});
