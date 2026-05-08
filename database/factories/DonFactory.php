<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Don>
 */
class DonFactory extends Factory
{
    public function definition(): array
    {
        $faker = fake('fr_FR');

        return [
            'montant' => $faker->numberBetween(5000, 500000),
            'devise' => 'FCFA',
            'donateur' => $faker->name(),
            'email' => $faker->userName().$faker->randomElement(['@gmail.com', '@yahoo.fr', '@orange.cm', '@camnet.cm']),
            'telephone' => $faker->optional()->numerify('6########'),
            'cause' => $faker->randomElement(['Recherche', 'Formation', 'Publication', 'Bourse doctorale', 'Developpement local']),
            'moyen' => $faker->randomElement(['mtn', 'orange', 'cinetpay', 'virement', 'paypal']),
            'statut' => $faker->randomElement(['confirme', 'en_attente', 'echec']),
            'date_don' => $faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
