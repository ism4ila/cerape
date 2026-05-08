<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Faq>
 */
class FaqFactory extends Factory
{
    public function definition(): array
    {
        $faker = fake('fr_FR');
        $questions = [
            'Quelle est la mission principale du CERAPE ?',
            'Comment participer a vos activites de recherche ?',
            'Publiez-vous des rapports accessibles au public ?',
            'Le CERAPE accompagne-t-il les collectivites territoriales ?',
            'Proposez-vous des formations pour les jeunes chercheurs ?',
            'Comment devenir partenaire du CERAPE ?',
            'Intervenez-vous uniquement au Cameroun ?',
            'Vos etudes sont-elles financees par des bailleurs externes ?',
            'Comment proposer un sujet d etude au CERAPE ?',
            'Comment soutenir financierement vos programmes ?',
        ];

        return [
            'question' => $faker->unique()->randomElement($questions),
            'reponse' => $faker->paragraphs(2, true),
            'ordre' => $faker->numberBetween(1, 30),
        ];
    }
}
