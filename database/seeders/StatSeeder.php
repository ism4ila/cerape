<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('stats')->insert([
            ['label' => 'Publications scientifiques', 'count' => 128, 'icon' => 'book-open', 'created_at' => now(), 'updated_at' => now()],
            ['label' => 'Chercheurs associes', 'count' => 34, 'icon' => 'users', 'created_at' => now(), 'updated_at' => now()],
            ['label' => 'Projets de recherche', 'count' => 52, 'icon' => 'diagram-project', 'created_at' => now(), 'updated_at' => now()],
            ['label' => 'Annees d existence', 'count' => 12, 'icon' => 'calendar-days', 'created_at' => now(), 'updated_at' => now()],
            ['label' => 'Collectivites accompagnees', 'count' => 41, 'icon' => 'city', 'created_at' => now(), 'updated_at' => now()],
            ['label' => 'Communes partenaires', 'count' => 27, 'icon' => 'landmark', 'created_at' => now(), 'updated_at' => now()],
            ['label' => 'Ateliers organises', 'count' => 96, 'icon' => 'chalkboard-user', 'created_at' => now(), 'updated_at' => now()],
            ['label' => 'Jeunes formes', 'count' => 720, 'icon' => 'graduation-cap', 'created_at' => now(), 'updated_at' => now()],
            ['label' => 'Etudes territoriales', 'count' => 63, 'icon' => 'map-location-dot', 'created_at' => now(), 'updated_at' => now()],
            ['label' => 'Institutions partenaires', 'count' => 18, 'icon' => 'handshake', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
