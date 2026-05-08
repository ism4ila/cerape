<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Galerie>
 */
class GalerieFactory extends Factory
{
    public function definition(): array
    {
        $faker = fake('fr_FR');

        return [
            'image_url' => 'storage/galerie/photo-'.$faker->unique()->numberBetween(1, 300).'.jpg',
            'legende' => $faker->sentence(10),
        ];
    }
}
