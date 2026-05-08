<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = fake('fr_FR');
        $prenoms = ['Aïssatou', 'Blaise', 'Clarisse', 'Didier', 'Estelle', 'Fabrice', 'Grâce', 'Hervé', 'Inès', 'Junior', 'Kevin', 'Laure', 'Mireille', 'Nadine', 'Ornella', 'Parfait', 'Rita', 'Serge', 'Trésor', 'Ulrich'];
        $noms = ['Nkoum', 'Tchoua', 'Mballa', 'Ngo Mvondo', 'Kamga', 'Mbarga', 'Ngono', 'Mbianda', 'Atangana', 'Essono', 'Dupont', 'Martin', 'Bernard', 'Lambert', 'Moreau'];
        $fullName = $faker->randomElement($prenoms).' '.$faker->randomElement($noms);

        return [
            'name' => $fullName,
            'email' => $faker->unique()->userName().$faker->randomElement(['@gmail.com', '@yahoo.fr', '@orange.cm', '@camnet.cm']),
            'role' => 'member',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'admin',
        ]);
    }

    public function superadmin(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'superadmin',
        ]);
    }

    public function editeur(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'editeur',
        ]);
    }

    public function member(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'member',
        ]);
    }
}
