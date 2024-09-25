<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Accomodation>
 */
class AccomodationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(2),
            'description' => $this->faker->paragraph(1),
            'type' => $this->faker->randomElement(['appartement', 'maison']),
            'price' => $this->faker->randomFloat(2, 150, 1500),
            'dispo' => rand(1, 2),
            'address' => $this->faker->streetAddress(),
            // 'cp' => $this->faker->postcode(),
            // 'city' =>  $this->faker->randomElement(['Paris', 'Etiolles']),
            // 'country' => 'France',
            'superficy' => $this->faker->randomFloat(2, 25, 400),
            'rooms' => rand(0, 5),
            'beds' => rand(1, 10),
            'persons' => rand(1, 10),
            'note' => $this->faker->randomFloat(2, 1, 5),
            'location_id' => rand(0, 35000)
        ];
    }
}
