<?php

use App\Models\Domaine;
use App\Models\Projet;
use App\Models\User;

function projetPayload(int $domaineId, array $overrides = []): array
{
    return array_merge([
        'titre' => 'Projet test',
        'domaine_id' => $domaineId,
        'description' => 'Description de projet',
        'lieu' => 'Dakar',
        'date_debut' => now()->toDateString(),
        'date_fin' => now()->addMonth()->toDateString(),
        'beneficiaires' => 120,
        'statut' => 'en_cours',
        'visible_public' => '1',
    ], $overrides);
}

it('allows admin to create a project', function () {
    $admin = User::factory()->admin()->create();
    $domaine = Domaine::create([
        'nom' => 'Agriculture',
        'slug' => 'agriculture',
        'description' => 'Description',
    ]);

    $this->actingAs($admin)
        ->post(route('admin.projets.store'), projetPayload($domaine->id))
        ->assertRedirect(route('admin.projets.index'))
        ->assertSessionHas('success');

    $this->assertDatabaseHas('projets', [
        'titre' => 'Projet test',
        'domaine_id' => $domaine->id,
    ]);
});

it('fails validation when title is missing', function () {
    $admin = User::factory()->admin()->create();
    $domaine = Domaine::create([
        'nom' => 'Santé',
        'slug' => 'sante',
        'description' => 'Description',
    ]);

    $this->actingAs($admin)
        ->from(route('admin.projets.create'))
        ->post(route('admin.projets.store'), projetPayload($domaine->id, ['titre' => '']))
        ->assertRedirect(route('admin.projets.create'))
        ->assertSessionHasErrors('titre');
});

it('generates slug automatically for projects', function () {
    $admin = User::factory()->admin()->create();
    $domaine = Domaine::create([
        'nom' => 'Éducation',
        'slug' => 'education',
        'description' => 'Description',
    ]);

    $this->actingAs($admin)->post(route('admin.projets.store'), projetPayload($domaine->id, [
        'titre' => 'Projet École',
    ]));

    $this->assertDatabaseHas('projets', [
        'titre' => 'Projet École',
        'slug' => 'projet-ecole',
    ]);
});

it('generates unique slugs for duplicate project titles', function () {
    $admin = User::factory()->admin()->create();
    $domaine = Domaine::create([
        'nom' => 'Protection',
        'slug' => 'protection',
        'description' => 'Description',
    ]);

    $this->actingAs($admin)->post(route('admin.projets.store'), projetPayload($domaine->id, [
        'titre' => 'Même projet',
    ]));
    $this->actingAs($admin)->post(route('admin.projets.store'), projetPayload($domaine->id, [
        'titre' => 'Même projet',
        'lieu' => 'Thiès',
    ]));

    $slugs = Projet::query()->where('titre', 'Même projet')->pluck('slug')->all();

    expect($slugs)->toContain('meme-projet');
    expect($slugs)->toContain('meme-projet-1');
});

it('allows admin to update an existing project', function () {
    $admin = User::factory()->admin()->create();
    $domaineA = Domaine::create([
        'nom' => 'A',
        'slug' => 'a',
        'description' => 'Description A',
    ]);
    $domaineB = Domaine::create([
        'nom' => 'B',
        'slug' => 'b',
        'description' => 'Description B',
    ]);
    $projet = Projet::create([
        'titre' => 'Projet initial',
        'slug' => 'projet-initial',
        'domaine_id' => $domaineA->id,
        'description' => 'Description',
        'lieu' => 'Lieu',
        'beneficiaires' => 1,
        'statut' => 'planifie',
        'visible_public' => true,
    ]);

    $this->actingAs($admin)
        ->put(route('admin.projets.update', $projet), projetPayload($domaineB->id, [
            'titre' => 'Projet modifié',
        ]))
        ->assertRedirect(route('admin.projets.index'));

    $this->assertDatabaseHas('projets', [
        'id' => $projet->id,
        'titre' => 'Projet modifié',
        'domaine_id' => $domaineB->id,
        'slug' => 'projet-modifie',
    ]);
});

it('allows superadmin to delete a project', function () {
    $superadmin = User::factory()->superadmin()->create();
    $domaine = Domaine::create([
        'nom' => 'Suppression',
        'slug' => 'suppression',
        'description' => 'Description',
    ]);
    $projet = Projet::create([
        'titre' => 'Projet supprimable',
        'slug' => 'projet-supprimable',
        'domaine_id' => $domaine->id,
        'description' => 'Description',
        'lieu' => 'Lieu',
        'beneficiaires' => 10,
        'statut' => 'en_cours',
        'visible_public' => true,
    ]);

    $this->actingAs($superadmin)
        ->delete(route('admin.projets.destroy', $projet))
        ->assertRedirect(route('admin.projets.index'));

    $this->assertDatabaseMissing('projets', ['id' => $projet->id]);
});

it('forbids editeur from deleting a project', function () {
    $editeur = User::factory()->editeur()->create();
    $domaine = Domaine::create([
        'nom' => 'Edition',
        'slug' => 'edition',
        'description' => 'Description',
    ]);
    $projet = Projet::create([
        'titre' => 'Projet non supprimable',
        'slug' => 'projet-non-supprimable',
        'domaine_id' => $domaine->id,
        'description' => 'Description',
        'lieu' => 'Lieu',
        'beneficiaires' => 10,
        'statut' => 'en_cours',
        'visible_public' => true,
    ]);

    $this->actingAs($editeur)
        ->delete(route('admin.projets.destroy', $projet))
        ->assertForbidden();
});

it('rejects non existing domaine_id during project creation', function () {
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)
        ->from(route('admin.projets.create'))
        ->post(route('admin.projets.store'), projetPayload(999999))
        ->assertRedirect(route('admin.projets.create'))
        ->assertSessionHasErrors('domaine_id');
});
