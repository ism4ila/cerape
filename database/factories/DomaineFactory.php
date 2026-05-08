<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Domaine>
 */
class DomaineFactory extends Factory
{
    public function definition(): array
    {
        $faker = fake('fr_FR');
        $domaines = [
            'Economie',
            'Sociologie',
            'Droit',
            'Sciences politiques',
            'Histoire',
            'Geographie',
            'Anthropologie',
            'Demographie',
            'Gestion publique',
            'Education',
        ];

        $nom = $faker->unique()->randomElement($domaines);

        return [
            'nom' => $nom,
            'slug' => Str::slug($nom),
            'description' => $faker->paragraphs(2, true),
            'icone' => $faker->randomElement(['book', 'scale-balanced', 'users', 'landmark', 'chart-line', 'graduation-cap']),
        ];
    }
}
