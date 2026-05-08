<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::query()->pluck('name')->all();
        if (count($users) === 0) {
            $users = ['Equipe CERAPE'];
        }

        $titles = [
            'Observatoire de la croissance inclusive au Cameroun',
            'Gouvernance locale et performance des services publics',
            'Transition numerique des collectivites territoriales',
            'Jeunesse, emploi et politiques actives du marche du travail',
            'Analyse des chaines de valeur agricoles en Afrique centrale',
            'Evaluation des politiques d education en zone rurale',
            'Financement des PME et inclusion financiere',
            'Mutations urbaines et cohesion sociale',
            'Migration interne et dynamiques territoriales',
            'Prospective economique et resilience des menages',
        ];

        foreach ($titles as $index => $title) {
            $status = $index < 6 ? 'publie' : ($index < 8 ? 'brouillon' : 'archive');
            $datePublication = $status === 'publie' ? now()->subDays(random_int(5, 420)) : null;

            Article::create([
                'titre' => $title,
                'slug' => Str::slug($title),
                'contenu' => '<p>Le CERAPE presente les premiers resultats de cette etude afin d eclairer le debat public et de proposer des pistes d action concretes.</p>'
                    .'<p>Nos chercheurs ont mobilise des donnees de terrain issues de plusieurs regions du Cameroun pour produire une lecture rigoureuse et operationnelle.</p>'
                    .'<p>Le rapport complet sera partage avec les institutions partenaires, les universites et les organisations de la societe civile.</p>',
                'auteur' => $users[array_rand($users)],
                'categorie' => ['Economie', 'Gouvernance', 'Recherche', 'Societe', 'Politique publique'][$index % 5],
                'image_url' => 'storage/articles/article-'.($index + 1).'.jpg',
                'tags' => ['Cameroun', 'Afrique centrale', 'CERAPE'],
                'statut' => $status,
                'date_publication' => $datePublication,
                'meta_description' => 'Article de recherche CERAPE sur les enjeux de developpement, de gouvernance et de transformation economique.',
            ]);
        }
    }
}
