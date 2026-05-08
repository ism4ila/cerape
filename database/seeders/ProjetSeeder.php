<?php

namespace Database\Seeders;

use App\Models\Domaine;
use App\Models\Projet;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjetSeeder extends Seeder
{
    public function run(): void
    {
        $domaines = Domaine::query()->pluck('id')->all();
        if (count($domaines) === 0) {
            return;
        }

        $titres = [
            'Programme de recherche sur les economies rurales',
            'Barometre citoyen des politiques locales',
            'Incubateur de jeunes chercheurs en sciences sociales',
            'Cartographie des inegalites territoriales',
            'Projet d observation des migrations internes',
            'Evaluation de l impact des investissements publics',
            'Laboratoire de gouvernance et innovation publique',
            'Etude longitudinale sur l emploi des jeunes diplomes',
            'Plateforme d appui aux communes camerounaises',
            'Programme regional de prospective socio-economique',
        ];

        foreach ($titres as $index => $titre) {
            $debut = now()->subMonths(random_int(3, 24));
            $fin = $index % 3 === 0 ? $debut->copy()->addMonths(random_int(8, 18)) : null;

            Projet::create([
                'titre' => $titre,
                'slug' => Str::slug($titre),
                'domaine_id' => $domaines[array_rand($domaines)],
                'description' => 'Ce projet de recherche appliquee vise a produire des recommandations solides pour les decideurs publics et les acteurs communautaires. '
                    .'Les activites incluent collecte de donnees, ateliers participatifs, publication de notes de synthese et accompagnement institutionnel.',
                'lieu' => ['Yaounde', 'Douala', 'Bafoussam', 'Bertoua', 'Garoua', 'Ngaoundere'][$index % 6],
                'date_debut' => $debut->toDateString(),
                'date_fin' => $fin?->toDateString(),
                'beneficiaires' => random_int(120, 2800),
                'images' => ['storage/projets/projet-'.($index + 1).'-1.jpg', 'storage/projets/projet-'.($index + 1).'-2.jpg'],
                'documents' => [['nom' => 'note-conceptuelle.pdf', 'url' => 'storage/documents/projet-'.($index + 1).'.pdf']],
                'statut' => ['en_cours', 'planifie', 'termine'][$index % 3],
                'partenaires' => ['Universite de Yaounde II', 'MINRESI', 'AFD'],
                'visible_public' => $index < 7,
            ]);
        }
    }
}
