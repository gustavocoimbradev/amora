<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reminder>
 */
class ReminderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'next_run_at' => Carbon::now()->addDays(1)->format('Y-m-d'),
            'frequency' => fake()->numberBetween(1,4),
            'next_run_at' => Carbon::now()->addDays(1)->format('Y-m-d'),
            'user_id' => User::factory()->create(),
        ];
    }
}
