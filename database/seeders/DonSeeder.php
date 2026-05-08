<?php

namespace Database\Seeders;

use App\Models\Don;
use Illuminate\Database\Seeder;

class DonSeeder extends Seeder
{
    public function run(): void
    {
        $statuts = ['confirme', 'confirme', 'confirme', 'confirme', 'confirme', 'confirme', 'confirme', 'en_attente', 'en_attente', 'echec'];

        foreach ($statuts as $index => $statut) {
            Don::factory()->create([
                'montant' => random_int(5000, 500000),
                'statut' => $statut,
                'date_don' => now()->subDays(random_int(1, 300)),
                'donateur' => ['Jean Nkoa', 'Aline Mballa', 'Gaston Ndzi', 'Mireille Fouda', 'Parfait Tchoua', 'Clarisse Atangana', 'Armand Ngono', 'Rita Kamga', 'Serge Mbarga', 'Irene Mvondo'][$index],
            ]);
        }
    }
}
