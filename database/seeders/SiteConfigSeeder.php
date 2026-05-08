<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiteConfigSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('site_configs')->insert([
            ['key' => 'nom_site', 'value' => 'CERAPE', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'email_contact', 'value' => 'contact@cerape.org', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'telephone', 'value' => '+237 6 99 00 11 22', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'adresse', 'value' => 'Avenue de l Independance, Yaounde, Cameroun', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'description', 'value' => 'Centre de recherche appliquee pour les politiques economiques et sociales.', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'facebook', 'value' => 'https://facebook.com/cerape', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'twitter', 'value' => 'https://twitter.com/cerape_cm', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'linkedin', 'value' => 'https://linkedin.com/company/cerape', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'site_name', 'value' => 'CERAPE', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'contact_email', 'value' => 'contact@cerape.org', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
