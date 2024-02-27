<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Accomodation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'accomodation_id' => rand(1, Accomodation::count()),
            'user_id' => rand(1, User::count()),
            'content' => $this->faker->paragraph(2),
            'title' => $this->faker->randomElement(['Excellent !', 'Superbe séjour !', 'Génial']),
            'note' => $this->faker->randomFloat(0, 1, 5),
        ];
    }
}
