<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $titres = [
            'Conference nationale sur les politiques publiques',
            'Seminaire CERAPE sur la competitivite des territoires',
            'Colloque interuniversitaire de sciences sociales',
            'Atelier de methodologie quantitative',
            'Forum emploi et innovation pour les jeunes',
            'Journée d etudes sur la decentralisation',
            'Debat public sur l inclusion economique',
            'Rencontre regionale des centres de recherche',
            'Session de formation en analyse de donnees',
            'Symposium sur la transformation structurelle',
        ];

        foreach ($titres as $index => $titre) {
            $date = $index < 5
                ? now()->addDays(random_int(12, 220))
                : now()->subDays(random_int(20, 260));

            Event::create([
                'titre' => $titre,
                'type' => ['formation', 'sensibilisation', 'ag', 'commemoration', 'autre'][$index % 5],
                'description' => 'Evenement organise par le CERAPE pour partager des resultats de recherche, renforcer les capacites et favoriser le dialogue entre acteurs publics et prives.',
                'date_heure' => $date,
                'lieu' => ['Yaounde', 'Douala', 'Bafoussam', 'Bertoua', 'Garoua', 'Maroua'][$index % 6],
                'capacite_max' => random_int(40, 250),
                'inscriptions_ouvertes' => $index < 5,
                'image_url' => 'storage/events/event-'.($index + 1).'.jpg',
            ]);
        }
    }
}
