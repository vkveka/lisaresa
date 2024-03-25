<?php

namespace Database\Factories;

use App\Models\Accomodation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'name' => 'default_picture_' . rand(1, 6) . '.jpg',
            // 'accomodation_id' => rand(1, Accomodation::count()),
        ];
    }
}
