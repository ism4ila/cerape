<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    public function definition(): array
    {
        $faker = fake('fr_FR');
        $sujet = $faker->randomElement([
            'Demande de partenariat institutionnel',
            'Informations sur vos publications',
            'Proposition de collaboration universitaire',
            'Question sur vos projets en cours',
            'Demande d intervention pour un atelier',
            'Appui a une etude locale',
        ]);

        return [
            'nom' => $faker->name(),
            'email' => $faker->userName().$faker->randomElement(['@gmail.com', '@yahoo.fr', '@orange.cm', '@camnet.cm']),
            'sujet' => $sujet,
            'message' => $faker->paragraphs(2, true),
            'lu' => $faker->boolean(60),
            'repondu' => $faker->boolean(45),
        ];
    }
}
