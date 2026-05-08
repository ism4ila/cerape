<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Partenaire>
 */
class PartenaireFactory extends Factory
{
    public function definition(): array
    {
        $faker = fake('fr_FR');
        $organisations = [
            'Universite de Yaounde II',
            'Universite de Douala',
            'Ministere de la Recherche Scientifique',
            'Agence Universitaire de la Francophonie',
            'Institut Panafricain de Gouvernance',
            'Fondation Horizon Afrique',
            'Observatoire Citoyen du Cameroun',
            'ONG Developpement Solidaire',
            'Centre d Etudes Regionales',
            'Reseau Jeunesse et Innovation',
        ];

        return [
            'nom' => $faker->unique()->randomElement($organisations),
            'logo_url' => 'storage/partenaires/logo-'.$faker->numberBetween(1, 20).'.png',
            'ordre' => $faker->numberBetween(1, 50),
        ];
    }
}
