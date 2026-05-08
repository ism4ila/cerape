<?php

namespace Database\Seeders;

use App\Models\Partenaire;
use Illuminate\Database\Seeder;

class PartenaireSeeder extends Seeder
{
    public function run(): void
    {
        $partenaires = [
            'Universite de Yaounde II',
            'Universite de Douala',
            'Ministere de la Recherche Scientifique et de l Innovation',
            'Ministere de l Economie, de la Planification et de l Amenagement du Territoire',
            'ONG Horizon Citoyen',
            'Fondation Afrique Developpement',
            'Institut de Gouvernance Publique',
            'Observatoire National des Territoires',
            'Reseau des Communes Innovantes',
            'Centre Regional de Statistique Appliquee',
        ];

        foreach ($partenaires as $index => $nom) {
            Partenaire::create([
                'nom' => $nom,
                'logo_url' => 'storage/partenaires/logo-'.($index + 1).'.png',
                'ordre' => $index + 1,
            ]);
        }
    }
}
