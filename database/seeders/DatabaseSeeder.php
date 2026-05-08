<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            DomaineSeeder::class,
            UserSeeder::class,
            ArticleSeeder::class,
            ProjetSeeder::class,
            EventSeeder::class,
            ContactSeeder::class,
            DonSeeder::class,
            PartenaireSeeder::class,
            FaqSeeder::class,
            GalerieSeeder::class,
            StatSeeder::class,
            SiteConfigSeeder::class,
            EventInscriptionSeeder::class,
            SubscriberSeeder::class,
        ]);
    }
}
