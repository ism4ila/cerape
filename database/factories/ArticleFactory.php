<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    public function definition(): array
    {
        $faker = fake('fr_FR');
        $titre = $faker->randomElement([
            'Dynamiques economiques locales au Cameroun',
            'Jeunesse et entrepreneuriat social en Afrique centrale',
            'Politiques publiques et reduction des inegalites',
            'Transition numerique des PME camerounaises',
            'Recherche appliquée et developpement territorial',
            'Souverainete alimentaire et resilience rurale',
            'Gouvernance locale et participation citoyenne',
            'Mutation des villes secondaires en Afrique',
            'Innovation sociale dans les zones periurbaines',
            'Cooperation regionale et croissance inclusive',
        ]);

        $statut = $faker->randomElement(['publie', 'brouillon', 'archive']);
        $datePublication = $statut === 'publie'
            ? $faker->dateTimeBetween('-18 months', '-2 days')
            : null;

        $auteur = User::query()->inRandomOrder()->value('name') ?? $faker->name();

        $paragraph1 = $faker->paragraph();
        $paragraph2 = $faker->paragraph();
        $paragraph3 = $faker->paragraph();

        return [
            'titre' => $titre,
            'slug' => Str::slug($titre).'-'.$faker->unique()->numberBetween(10, 9999),
            'contenu' => "<p>{$paragraph1}</p><p>{$paragraph2}</p><p>{$paragraph3}</p>",
            'auteur' => $auteur,
            'categorie' => $faker->randomElement(['Economie', 'Societe', 'Gouvernance', 'Recherche', 'Developpement', 'Afrique']),
            'image_url' => $faker->optional(0.7)->imageUrl(1200, 700, 'business', true, 'cerape'),
            'tags' => $faker->randomElements(['Cameroun', 'Afrique', 'Politique publique', 'Recherche', 'Developpement', 'Economie'], 3),
            'statut' => $statut,
            'date_publication' => $datePublication,
            'meta_description' => $faker->sentence(20),
        ];
    }
}
