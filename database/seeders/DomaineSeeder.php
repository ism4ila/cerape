<?php

namespace Database\Seeders;

use App\Models\Domaine;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DomaineSeeder extends Seeder
{
    public function run(): void
    {
        $domaines = [
            ['nom' => 'Economie', 'description' => 'Analyses des dynamiques de croissance, d emploi et de politiques budgetaires au Cameroun.'],
            ['nom' => 'Sociologie', 'description' => 'Etudes sur les transformations sociales, la jeunesse et les inegalites territoriales.'],
            ['nom' => 'Droit', 'description' => 'Recherches sur les cadres juridiques publics, la justice sociale et la regulation.'],
            ['nom' => 'Sciences politiques', 'description' => 'Travaux sur la gouvernance, les institutions et la participation citoyenne.'],
            ['nom' => 'Histoire', 'description' => 'Mise en perspective historique des politiques publiques et des trajectoires nationales.'],
            ['nom' => 'Geographie', 'description' => 'Approches territoriales des mobilites, de l urbanisation et du developpement local.'],
            ['nom' => 'Anthropologie', 'description' => 'Comprendre les pratiques culturelles et les dynamiques communautaires contemporaines.'],
            ['nom' => 'Demographie', 'description' => 'Analyses de population, transitions demographiques et pression sur les services publics.'],
            ['nom' => 'Gestion publique', 'description' => 'Evaluation de la performance administrative et modernisation de l action publique.'],
            ['nom' => 'Education', 'description' => 'Recherche sur la qualite educative, l insertion et les innovations pedagogiques.'],
        ];

        foreach ($domaines as $index => $domaine) {
            Domaine::updateOrCreate(
                ['slug' => Str::slug($domaine['nom'])],
                [
                    'nom' => $domaine['nom'],
                    'slug' => Str::slug($domaine['nom']),
                    'description' => $domaine['description'],
                    'icone' => ['chart-line', 'users', 'scale-balanced', 'landmark', 'book-open', 'map', 'people-group', 'chart-pie', 'building-columns', 'graduation-cap'][$index],
                ]
            );
        }
    }
}
