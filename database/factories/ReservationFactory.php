<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Accomodation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => rand(1, User::count()),
            'accomodation_id' => rand(1, Accomodation::count()),
            'date_in' => now(),
            'date_out' => now()->addDays(rand(2, 8)),
            'numero' => rand(10000000, 99999999),
            'price' => $this->faker->randomFloat(2, 150, 1500),
        ];
    }
}
