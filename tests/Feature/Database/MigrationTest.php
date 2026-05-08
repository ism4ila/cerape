<?php

use App\Models\Domaine;
use App\Models\Projet;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

it('creates expected tables after migrations', function () {
    $tables = [
        'users',
        'domaines',
        'articles',
        'projets',
        'events',
        'contacts',
        'dons',
        'site_configs',
    ];

    foreach ($tables as $table) {
        expect(Schema::hasTable($table))->toBeTrue();
    }
});

it('has foreign key from projets.domaine_id to domaines.id', function () {
    $foreignKeys = DB::select("PRAGMA foreign_key_list('projets')");
    $fkColumns = collect($foreignKeys)->pluck('from')->all();
    $fkTables = collect($foreignKeys)->pluck('table')->all();

    expect($fkColumns)->toContain('domaine_id');
    expect($fkTables)->toContain('domaines');
});

it('creates composite and performance indexes', function () {
    $articleIndexes = collect(DB::select("PRAGMA index_list('articles')"))->pluck('name')->all();
    $projetIndexes = collect(DB::select("PRAGMA index_list('projets')"))->pluck('name')->all();
    $eventIndexes = collect(DB::select("PRAGMA index_list('events')"))->pluck('name')->all();

    expect($articleIndexes)->toContain('articles_statut_date_publication_index');
    expect($projetIndexes)->toContain('projets_visible_public_created_at_index');
    expect($eventIndexes)->toContain('events_date_heure_index');
});

it('rejects project creation with invalid domaine_id at database level', function () {
    $this->expectException(QueryException::class);

    Projet::create([
        'titre' => 'Projet FK invalide',
        'slug' => 'projet-fk-invalide',
        'domaine_id' => 999999,
        'description' => 'Description',
        'lieu' => 'Lieu',
        'beneficiaires' => 1,
        'statut' => 'en_cours',
        'visible_public' => true,
    ]);
});

it('accepts project creation with valid domaine_id', function () {
    $domaine = Domaine::create([
        'nom' => 'FK valide',
        'slug' => 'fk-valide',
        'description' => 'Description',
    ]);

    $projet = Projet::create([
        'titre' => 'Projet FK valide',
        'slug' => 'projet-fk-valide',
        'domaine_id' => $domaine->id,
        'description' => 'Description',
        'lieu' => 'Lieu',
        'beneficiaires' => 1,
        'statut' => 'en_cours',
        'visible_public' => true,
    ]);

    expect($projet->exists)->toBeTrue();
});
