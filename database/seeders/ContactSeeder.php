<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        $sujets = [
            'Demande d information generale',
            'Proposition de partenariat',
            'Demande d intervention dans une universite',
            'Question sur les publications',
            'Besoin d accompagnement methodologique',
            'Demande de rendez-vous institutionnel',
            'Suivi d une demande precedente',
            'Proposition de conference',
            'Appui pour une etude locale',
            'Demande de documentation',
        ];

        foreach ($sujets as $index => $sujet) {
            Contact::factory()->create([
                'sujet' => $sujet,
                'message' => 'Bonjour, je vous contacte pour obtenir plus de details concernant vos activites et les modalites de collaboration possibles avec notre structure.',
                'lu' => $index < 6,
                'repondu' => $index < 5,
            ]);
        }
    }
}
