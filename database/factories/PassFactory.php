<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Pass;

class PassFactory extends Factory
{
    protected $model = Pass::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'total_sessions' => fake()->randomElement([5, 10]),
            'remaining_sessions' => fake()->randomElement([0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
            'purchase_date' => fake()->date(),
        ];
    }
}
