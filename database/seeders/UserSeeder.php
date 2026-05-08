<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->superadmin()->create([
            'name' => 'Direction CERAPE',
            'email' => 'admin@cerape.org',
            'password' => 'password',
        ]);

        User::factory()->admin()->count(2)->create();
        User::factory()->editeur()->count(3)->create();
        User::factory()->member()->count(4)->create();
    }
}
