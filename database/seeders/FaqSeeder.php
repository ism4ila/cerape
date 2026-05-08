<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Quelle est la mission du CERAPE ?',
                'reponse' => 'Le CERAPE produit des recherches appliquees pour accompagner les politiques publiques, renforcer la gouvernance et soutenir le developpement territorial au Cameroun.',
            ],
            [
                'question' => 'Comment acceder a vos publications ?',
                'reponse' => 'Nos notes, rapports et articles sont publies progressivement sur notre plateforme et peuvent etre demandes via le formulaire de contact.',
            ],
            [
                'question' => 'Le CERAPE travaille-t-il avec les universites ?',
                'reponse' => 'Oui, nous collaborons avec plusieurs universites et laboratoires pour des projets de recherche, de formation et de valorisation des donnees.',
            ],
            [
                'question' => 'Comment proposer un partenariat institutionnel ?',
                'reponse' => 'Vous pouvez nous ecrire avec vos objectifs, votre zone d intervention et vos attentes. Notre equipe analysera ensuite les axes de collaboration possibles.',
            ],
            [
                'question' => 'Organisez-vous des conferences et seminaires ?',
                'reponse' => 'Oui, le CERAPE organise regulierement des colloques, conferences et sessions de formation sur les enjeux economiques et sociaux.',
            ],
            [
                'question' => 'Peut-on soutenir financierement vos programmes ?',
                'reponse' => 'Absolument. Les dons contribuent au financement des etudes, des activites de terrain et de la diffusion des resultats de recherche.',
            ],
            [
                'question' => 'Intervenez-vous en dehors de Yaounde et Douala ?',
                'reponse' => 'Oui, nos travaux couvrent plusieurs regions du Cameroun avec des activites adaptees aux contextes locaux.',
            ],
            [
                'question' => 'Accompagnez-vous les collectivites territoriales ?',
                'reponse' => 'Nous proposons un appui technique aux communes pour le diagnostic territorial, le suivi des politiques et la planification locale.',
            ],
            [
                'question' => 'Comment rejoindre vos activites de formation ?',
                'reponse' => 'Les annonces de formation sont publiees dans notre agenda. Vous pouvez aussi envoyer votre demande de participation par email.',
            ],
            [
                'question' => 'Le CERAPE propose-t-il des stages de recherche ?',
                'reponse' => 'Oui, selon les programmes en cours, nous accueillons des stagiaires et jeunes chercheurs avec un encadrement scientifique.',
            ],
        ];

        foreach ($faqs as $index => $faq) {
            Faq::create([
                'question' => $faq['question'],
                'reponse' => $faq['reponse'],
                'ordre' => $index + 1,
            ]);
        }
    }
}
