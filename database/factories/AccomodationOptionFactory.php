<?php

namespace Database\Factories;

use App\Models\Option;
use App\Models\Accomodation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AccomodationOption>
 */
class AccomodationOptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'option_id' => rand(1, Option::count()),
            'accomodation_id' => rand(1, Accomodation::count()),
        ];
    }
}
