<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscriber>
 */
class SubscriberFactory extends Factory
{
    public function definition(): array
    {
        $faker = fake('fr_FR');

        return [
            'email' => $faker->unique()->userName().$faker->randomElement(['@gmail.com', '@yahoo.fr', '@orange.cm', '@camnet.cm']),
        ];
    }
}
