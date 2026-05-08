<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    public function definition(): array
    {
        $faker = fake('fr_FR');
        $titre = $faker->randomElement([
            'Conference sur les transformations economiques en Afrique centrale',
            'Seminaire methodologique en sciences sociales',
            'Colloque CERAPE sur la gouvernance locale',
            'Atelier de redaction scientifique',
            'Forum regional sur l emploi des jeunes',
            'Rencontre des acteurs de la recherche appliquee',
            'Table ronde sur les politiques publiques territoriales',
            'Journée d etudes sur les dynamiques rurales',
            'Debat public sur les donnees ouvertes',
            'Session de formation en evaluation de projets',
        ]);

        return [
            'titre' => $titre,
            'type' => $faker->randomElement(['formation', 'sensibilisation', 'ag', 'commemoration', 'autre']),
            'description' => $faker->paragraphs(2, true),
            'date_heure' => $faker->dateTimeBetween('-8 months', '+8 months'),
            'lieu' => $faker->randomElement(['Yaounde', 'Douala', 'Bafoussam', 'Bertoua', 'Garoua', 'Maroua', 'Kribi', 'Edea']),
            'capacite_max' => $faker->numberBetween(30, 300),
            'inscriptions_ouvertes' => $faker->boolean(60),
            'image_url' => $faker->optional(0.65)->imageUrl(1200, 675, 'business', true, 'event'),
        ];
    }
}
