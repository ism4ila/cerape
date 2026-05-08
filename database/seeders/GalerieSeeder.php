<?php

namespace Database\Seeders;

use App\Models\Galerie;
use Illuminate\Database\Seeder;

class GalerieSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            Galerie::create([
                'image_url' => 'storage/galerie/photo-'.$i.'.jpg',
                'legende' => 'Activite CERAPE sur le terrain - session '.$i,
            ]);
        }
    }
}
