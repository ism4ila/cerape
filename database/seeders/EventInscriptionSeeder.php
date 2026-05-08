<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventInscriptionSeeder extends Seeder
{
    public function run(): void
    {
        $events = Event::query()->pluck('id')->all();
        if (count($events) === 0) {
            return;
        }

        $faker = fake('fr_FR');
        $rows = [];

        for ($i = 0; $i < 10; $i++) {
            $rows[] = [
                'event_id' => $events[array_rand($events)],
                'nom' => $faker->name(),
                'email' => $faker->userName().'@gmail.com',
                'telephone' => $faker->numerify('6########'),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('event_inscriptions')->insert($rows);
    }
}
