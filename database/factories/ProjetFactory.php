<?php

namespace Database\Factories;

use App\Models\Domaine;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Projet>
 */
class ProjetFactory extends Factory
{
    public function definition(): array
    {
        $faker = fake('fr_FR');
        $titre = $faker->randomElement([
            'Observatoire des filieres agricoles locales',
            'Cartographie des vulnerabilites socio-economiques',
            'Programme d appui aux jeunes chercheurs',
            'Evaluation de l impact des politiques communales',
            'Barometre de la gouvernance territoriale',
            'Etude sur les migrations internes au Cameroun',
            'Laboratoire citoyen de donnees publiques',
            'Plateforme de suivi des projets communautaires',
            'Projet d innovation rurale inclusive',
            'Analyse prospective des metiers emergents',
        ]);

        $debut = $faker->dateTimeBetween('-2 years', '+2 months');
        $fin = $faker->boolean(70) ? (clone $debut)->modify('+'.random_int(3, 16).' months') : null;

        return [
            'titre' => $titre,
            'slug' => Str::slug($titre).'-'.$faker->unique()->numberBetween(10, 9999),
            'domaine_id' => Domaine::query()->inRandomOrder()->value('id') ?? Domaine::factory(),
            'description' => $faker->paragraphs(4, true),
            'lieu' => $faker->randomElement(['Yaounde', 'Douala', 'Bafoussam', 'Bertoua', 'Garoua', 'Maroua', 'Ebolowa', 'Ngaoundere']),
            'date_debut' => $debut,
            'date_fin' => $fin,
            'beneficiaires' => $faker->numberBetween(80, 3500),
            'images' => [
                'storage/projets/'.Str::slug($titre).'-1.jpg',
                'storage/projets/'.Str::slug($titre).'-2.jpg',
            ],
            'documents' => [
                ['nom' => 'note-conceptuelle.pdf', 'url' => 'storage/documents/'.Str::slug($titre).'-note.pdf'],
            ],
            'statut' => $faker->randomElement(['en_cours', 'termine', 'planifie']),
            'partenaires' => $faker->randomElements(['MINRESI', 'IRD', 'Universite de Yaounde II', 'UNESCO', 'AFD', 'PNUD'], 2),
            'visible_public' => $faker->boolean(70),
        ];
    }
}
