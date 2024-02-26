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
            'image' => 'default_pisture_' . rand(1, Accomodation::count()) . '.jpg',
            'accomodation_id' => rand(1, Accomodation::count()),
        ];
    }
}
